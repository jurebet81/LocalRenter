<?php

class ExpensesController extends AppController {
        
        public $helpers = array('Html','Form');
        public $components = array('Session','RequestHandler');
        public $cond = array();
                
        public $paginate = array(  //join for retrieve purchase details and prices...
            'fields' => array(
                'Purchase.id', 
                'Pr.name',
                'Purchase.id_invoice',
                //'Purchase.date_requested',
                'Purchase.date_delivered',
                'SUM(Purchasedetails.total_price) AS total',
                'Purchase.observations',               
            ),
            'group' => array('Purchasedetails.purchase_id'),
            'recursive' => 0,
            'limit' => 15,
            'joins' => array(                
                    array (
                        'table' => 'purchasedetails',
                        'alias' => 'Purchasedetails',
                        'conditions' => array('Purchasedetails.purchase_id = Purchase.id')
                    ),
                    array (
                        'table' => 'providers',
                        'alias' => 'Pr',
                        'conditions' => array('Pr.id = Purchase.provider_id')
                    ), 
            ),            
            'order' => array('Purchase.date_delivered' => 'desc'),             
        );
        
	public function index(){	
             
            if ($this->request->is('post')){                 
                $this->redirect(array('controller' => 'expenses', 'action' => 'view'));                
                
            }else{                
                              	
                $locations = array('-1' => '');
            	$paramsLoc = array(
            			'order' => array( //contidion is defined to find apartamens in ascencdent order
            					'Location.name' => 'ASC'));
            	
            	$this->loadModel('Location');
            	array_push($locations, $this->Location->find('list',$paramsLoc));
            	$this->set('locations',$locations);
            	 
            }                       
           
            $this->layout = 'home';
	}
        
        public function add(){      
            
            if ($this->request->is('post')){                         
                //$this->request->data['Purchase']['date_requested'] = date('Y-m-d',strtotime($this->request->data['Purchase']['date_requested']));
                $this->request->data['Expense']['date'] = date('Y-m-d',strtotime($this->request->data['Expense']['date']));  
                
                //$message = $this->custoValidation($this->request->data);
                $message = null;
                if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                    $this->redirect(array('action' => 'add'));
                    return;
                }                 
                if ($this->Expense->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'> Gasto ingresado correctamente.</div>");
                    $this->redirect(array('action' => 'add'));
                }
            }else{
            	
            	$locations = array('-1' => '');
            	$paramsLoc = array(
            			'order' => array( //contidion is defined to find apartamens in ascencdent order
            					'Location.name' => 'ASC'));
            	
            	$this->loadModel('Location');
            	array_push($locations, $this->Location->find('list',$paramsLoc));
            	$this->set('locations',$locations);
            }
            $this->layout = 'home';
        }
        
        public function view(){  
            $fromDate = '';
            $toDate = '';
            $provider_id = -1;            
                        
            if ($this->request->is('post')){ 
            	
                $data = $this->request->data; 
                
                $fromDate = $data['Expense']['FromDate'];
                $toDate = $data['Expense']['ToDate'];
                $location_id = $data['Expense']['location_id'];  
                $apartment_id = $data['Expense']['apartment_id'];
                
                $conditions = $this->findConditions($fromDate,$toDate,$location_id,$apartment_id);  
                
                $this->Session->write('conditionsP', $conditions);
                
                $this->cond = array ($conditions);
                $this->paginate['conditions'] = $this->cond;  
                $purchases = $this->paginate();  
                //array_push($purchases, array('fDate' => $fromDate,'tDate' => $toDate,'provider' => $provider_id));
                
                if ($this->request->is('requested')){   //pregunta de eleeento
                    return $purchases;
                }else{
                    $this->set('purchases',$purchases);         
                }
            }else{
                if ($this->Session->check('conditions')){                    
                    $conditions = $this->Session->read('conditionsP');
                    //$this->log($conditions);
                }
                                                 
                $this->cond = array ($conditions);                
                $this->Purchase->recursive = 0; 
                $this->paginate['conditions'] = $this->cond;
                $purchases = $this->paginate();
                               
                if ($this->request->is('requested')){ //pregunta de eleeento
                    return $purchases;
                }else{
                    $this->set('purchases',$purchases);                
                }                 
            }
            $this->layout = 'home';           
        }
        
        public function fetchApartments($id = null){
        
        	$paramsApar = array(
        			'conditions' => array(        					
        					'Apartment.location_id' => $id),
        			'order' => array( 
        					'Apartment.name' => 'DESC'));
        	
        	$this->set('apartments', $this->Expense->Apartment->find('all',$paramsApar));
        
        }
        
        private function custoValidation($newPurchase){
           
            $message=null;
           
           if (empty($newPurchase['Purchase']['provider_id'])){
               $message = 'Proveedor: Debe seleccionar un proveedor.';
           }else if (empty($newPurchase['Purchase']['id_invoice'])){
                $message = 'Factura Nro: Es un campo obligatorio';
            //}else if (date('Y',strtotime($newPurchase['Purchase']['date_requested'])) < 2010){
                //$message = 'Fecha de pedido: Debe ingresar una fecha válida';
            }else if(date('Y',strtotime($newPurchase['Purchase']['date_delivered'])) < 2010){
                $message = 'Fecha de recepción: Debe ingresar una fecha válida';
            }  
            return $message;            
        }
             
        
        public function findConditions($fromDate,$toDate,$location_id,$apartment_id){
            $conditions = '';
            
            if ($location_id > 0 && $apartment_id < 1){
            	//buscar los id de location
            }
            
            if ($fromDate!='' && $toDate != ''){
                $fromDate = date('Y-m-d',strtotime($fromDate));
                $toDate = date('Y-m-d',strtotime($toDate)); 
                $conditions = "Expense.date >= " . "'" . $fromDate . "'" . 
                        " AND Expense.date <= " . "'" . $toDate . "'";
                
                if ($location_id >0 && $apartment_id > 0){ //Date, apartment
                 	$conditions .= " AND Expense.apartment_id = '" . apartment_id . "'";
                }else if($location_id >0 && $apartment_id < 1){
                	
                }
                    
            }  
                
            
            
            return $conditions;                
                
        }
        
        public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurrió un error durante la acción solicitada,
                vuelva a intentarlo, si el error persiste por favor contacte al administrador,
                ofrecemos disculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }

}
?>