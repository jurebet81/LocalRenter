<?php
class ApartmentsController extends AppController {
    
        public $helpers = array('Html','Form','Js' => array('Jquery'));
        public $components = array('Session','RequestHandler'); 
        
        public $paginate = array(
            'limit' => 15,
            'order' => array('Apartment.name' => 'asc'),
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
                if ($this->Apartment->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Apartamento ingresado correctamente.</div>");
                    $this->redirect(array('action' => 'add'));
                }else{
                    $this->Session->setFlash("<div class = 'err'>Hubo un error, por favor contacte al administrador.</div>");
                    $this->redirect(array('action' => 'error'));
                }
            }else {
                
                $params = array('order' => array( //contidion is defined to find apartamens in ascencdent order
                'Location.name' => 'ASC'));
            
                $this->log( $this->Apartment->Location->find('list',$params));            
                $this->set('locations', $this->Apartment->Location->find('list',$params));  //send apartments to populate dropdownlist
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
        
        public function custoValidation($apartment){
           
           $message=null;
           
           if (!is_numeric($apartment['Apartment']['rent_price'])){
               $message = 'Valor de Renta: Debe ingresar valor númerico.';
           }else if($apartment['Apartment']['rent_price'] < 1){
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