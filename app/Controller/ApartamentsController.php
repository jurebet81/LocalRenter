<?php
class ApartamentsController extends AppController {
    
        public $helpers = array('Html','Form','Js' => array('Jquery'));
        public $components = array('Session','RequestHandler'); 
        
        public $paginate = array(
            'limit' => 15,
            'order' => array('Apartament.name' => 'asc'),
        );
        
	public function index(){	
            $this->layout = 'home';	
	}
	
        public function add(){
            
            if ($this->request->is('post')){ 
                
                $message = $this->custoValidation($this->request->data);
				
                if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err'>" . $message . "</div>");
                    $this->redirect(array('action' => 'add'));
                    return;
                } 
                               
                //date_default_timezone_set('America/New_York'); 				
                //$today = getdate();
                //$this->request->data['Product']['date_submitted'] = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];              
                if ($this->Apartament->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Apartament ingresado correctamente.</div>");
                    $this->redirect(array('controller' => 'apartaments', 'action' => 'add'));
                }else{
                    $this->Session->setFlash("<div class = 'err'>Hubo un error, por favor contacte al administrador.</div>");
                    $this->redirect(array('action' => 'error'));
                }
            }else {
                
                $params = array('order' => array( //contidion is defined to find apartamens in ascencdent order
                'Location.name' => 'ASC'));
            
                $this->log( $this->Apartament->Location->find('list',$params));            
                $this->set('locations', $this->Apartament->Location->find('list',$params));  //send apartaments to populate dropdownlist
            }            
            $this->layout = 'home';
        }
        
        public function view(){             
           $this->Product->recursive = 0; 
            $products = $this->paginate();
            if ($this->request->is('requested')){ //pregunta de eleeento
                return $products;
            }else{
                $this->set('products',$products);                
            } 
            $this->layout = 'home';    
        }
        
         public function edit($id = null){            
            $this->Product->id = $id;
            if ($this->request->is('get')){
                $this->request->data = $this->Product->read();
                
            }else{
                
                $message = $this->custoValidation($this->request->data);
                if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err'>" . $message . "</div>");
                    $this->redirect(array('action' => 'edit', $this->Client->id));                    
                }
                
                if($this->Product->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Producto actualizado con éxito.</div>");
                    $this->redirect(array('action' => 'view'));
                }
            }
            $this->layout = 'home';
        }
        
        public function getData($id = null){
            $this->Product->id = $id;
            $this->set('product',$this->Product->read(null,$id));
            $this->layout = 'ajax';            
        }
        
        public function custoValidation($apartament){
           
           $message=null;
           
           if (!is_numeric($apartament['Apartament']['rent_price'])){
               $message = 'Valor de Renta: Debe ingresar valor númerico.';
           }else if($apartament['Apartament']['rent_price'] < 1){
               $message = 'Valor de Renta: Debe ser un valor mayor a 0.';           
           }       
           return $message;            
        }
        
         public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurrió un error durante la acción solicitada,
                vuelva a intetarlo, si el error persiste por favor contacte al administrador,
                pedimos dusculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }
}
?>