<?php
class ApartmentsController extends AppController {
    
    public $helpers = array('Html','Form','Js' => array('Jquery'));
    public $components = array('Session','RequestHandler'); 
        
    public $paginate = array(  //join for retrieve sales details and prices together...
    		'fields' => array(
    				'Apartment.id',    				
    				'Locat.name',
    				'Apartment.name',
    				'Apartment.address',
    				'Apartment.rent_price',
    				'Apartment.available',    				
    		),
    		'recursive' => 0,
    		'limit' => 15,
    		'joins' => array(
    				array (
    						'table' => 'locations',
    						'alias' => 'Locat',
    						'conditions' => array('Locat.id = Apartment.location_id')
    				),
    		),
    		'order' => array('Apartment.available' => 'ASC',
    				'Apartment.name' => 'ASC'
    		),
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
            $this->set('locations', $this->Apartment->Location->find('list',$params));  //send apartments to populate dropdownlist
        } 
                   
        $this->layout = 'home';
    }
        
    public function view(){             
        $this->Apartment->recursive = 0; 
        
        $apartments = $this->paginate();
        if ($this->request->is('requested')){ //pregunta de eleeento
            return $aparments;
        }else{
            $this->set('apartments',$apartments);                
        } 
        
        $this->layout = 'home';    
    }
        
    public function edit($id = null){            
        $this->Apartment->id = $id;
        
        if ($this->request->is('get')){
            $this->request->data = $this->Apartment->read();                
        }else{                
            //$message = $this->custoValidation($this->request->data);
            $message = null;
            
            if ($message!=null){                  
                $this->Session->setFlash("<div class = 'err'>" . $message . "</div>");
                $this->redirect(array('action' => 'edit', $this->Client->id));                    
            }
               
            if($this->Apartment->save($this->request->data)){
                $this->Session->setFlash("<div class = 'info'>Datos de apartamento actualizados con éxito.</div>");
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