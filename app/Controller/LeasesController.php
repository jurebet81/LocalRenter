<?php

class LeasesController extends AppController {
        
        public $helpers = array('Html','Form');
        public $components = array('Session','RequestHandler');
        public $cond = array();
        
         
            
	public function index(){	
            
            if ($this->request->is('post')){                 
                $this->redirect(array('controller' => 'sales', 'action' => 'view'));                 
                
            }else{
                
                $params = array('order' => array( //contidion is defined to find clients in ascencdent order
                'Client.name' => 'ASC'),
                );
                $clients = array('-1' => '');
                array_push($clients, $this->Sale->Client->find('list',$params));             
                $this->set('clients', $clients);                
                
                $sales = $this->paginate(array ('conditions'=>$this->cond));
                $this->set('sales',$sales);  
            }                       
           
            $this->layout = 'home';	
	}
        
        public function add(){            
            
             if ($this->request->is('post')){                         
                $this->request->data['Sale']['date'] = date('Y-m-d',strtotime($this->request->data['Sale']['date']));   
                
                $message = $this->custoValidation($this->request->data);
                if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                    $this->redirect(array('action' => 'add'));
                    return;
                } 
                               
                if ($this->Sale->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Venta ingresada correctamente, ahora proceda a ingresar los productos</div>");
                    $this->redirect(array('controller' => 'saledetails', 'action' => 'add', $this->Sale->id));
                }  
            }else {
                
                $paramsLoc = array(                    
                    'order' => array( //contidion is defined to find apartamens in ascencdent order
                        'Location.name' => 'ASC'));
                
                $this->loadModel('Location');
                $locations = $this->Location->find('list',$paramsLoc);
                $this->set('locations',$locations);
                
            }
            $this->layout = 'home';
        }
        
        public function fetchApartaments($id = null){
              
            
            $paramsApar = array(
                    'conditions' => array(
                        'Apartament.available' => 'si',
                        'Apartament.location_id' => $id),
                    'order' => array( //contidion is defined to find apartamens in ascencdent order
                        'Apartament.name' => 'ASC'));               
                            
                $this->log( $this->Lease->Apartament->find('list',$paramsApar));            
                $this->set('apartaments', $this->Lease->Apartament->find('list',$paramsApar)); 
        }
        
        public function view(){
            $fromDate = '';
            $toDate = '';
            $client_id = -1;
            
            if ($this->request->is('post')){ 
                $data = $this->request->data; 
                
                $fromDate = $data['Sale']['FromDate'];
                $toDate = $data['Sale']['ToDate'];
                $client_id = $data['Sale']['client_id'];                                  
                
                $conditions = $this->findConditions($fromDate,$toDate,$client_id);  
                
                $this->Session->write('conditionsS', $conditions);
                
                $this->cond = array ($conditions);
                $this->paginate['conditions'] = $this->cond;  
                $sales = $this->paginate();  
                
                
                if ($this->request->is('requested')){   //pregunta de eleeento
                    return $sales;
                }else{
                    $this->set('sales',$sales);         
                }
            }else{
                if ($this->Session->check('conditions')){                    
                    $conditions = $this->Session->read('conditionsS');
                    //$this->log($conditions);
                }
                                                 
                $this->cond = array ($conditions);                
                $this->Sale->recursive = 0; 
                $this->paginate['conditions'] = $this->cond;
                $sales = $this->paginate();
                               
                if ($this->request->is('requested')){ //pregunta de eleeento
                    return $sales;
                }else{
                    $this->set('sales',$sales);                
                }                 
            }
            $this->layout = 'home'; 
            
        }
	        
        public function custoValidation($newSale){
           
           $message=null;
           
           if (($newSale['Sale']['client_id']) == null){
               $message = 'Cliente: Debe seleccionar un cliente.';
           } else if (date('Y',strtotime($newSale['Sale']['date'])) < 2010){
               $message = 'Fecha: Debe ingresar una fecha válida.';
           }      
           return $message;            
        }
        
        public function findConditions($fromDate,$toDate,$client_id){
            $conditions = '';
            if ($fromDate!='' && $toDate != ''){
                    $fromDate = date('Y-m-d',strtotime($fromDate));
                    $toDate = date('Y-m-d',strtotime($toDate)); 
                    $conditions = "Sale.date >= " . "'" . $fromDate . "'" . 
                            " AND Sale.date <= " . "'" . $toDate . "'";
            }  
                
            if ($client_id >0 && strlen($conditions)>0){
                $conditions = $conditions . " AND Sale.client_id = '" . 
                        $client_id . "'";
                    
            }else if ($client_id>0){
                $conditions = $conditions . "Sale.client_id = '" . 
                        $client_id . "'";
            }
            
            return $conditions;                
                
        }
        
        public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurrió un error durante la acción solicitada,
                vuelva a intetarlo, si el error persiste por favor contacte al administrador,
                pedimos dusculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }

}
?>