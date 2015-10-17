<?php

class ExpensesController extends AppController {
        
        public $helpers = array('Html','Form');
        public $components = array('Session','RequestHandler');
        public $cond = array();
                
        public $paginate = array(  
            'fields' => array(
                'Expense.id', 
                'Apto.name',
            	'Expense.description',
                'Expense.amount',
                'Expense.date',  
            ),            
            'recursive' => 0,
            'limit' => 15,
            'joins' => array(  
                    array (
                        'table' => 'apartments',
                        'alias' => 'Apto',
                        'conditions' => array('Apto.id = Expense.apartment_id')
                    ), 
            ),            
            'order' => array('Expense.date' => 'DESC'),             
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
            $location_id = -1;   
            $apartment_id = -1;
                        
            if ($this->request->is('post')){ 
            	
                $data = $this->request->data;                  
                           
                $fromDate = $data['Expense']['FromDate'];
                $toDate = $data['Expense']['ToDate'];
                $location_id = $data['Expense']['location_id'];  
                $apartment_id = $data['Expense']['apartment_id'];                
                
                $conditions = $this->findConditions($fromDate,$toDate,$location_id,$apartment_id);  
                                
                $this->Session->write('conditions', $conditions);
                
                $this->cond = array ($conditions);
                $this->paginate['conditions'] = $this->cond;  
                $expenses = $this->paginate();  
                                
                if ($this->request->is('requested')){   //pregunta de eleeento
                    return $expenses;
                }else{
                    $this->set('expenses',$expenses);         
                }                               
                
            }else{
            	
                if ($this->Session->check('conditions')){                    
                    $conditions = $this->Session->read('conditions');                   
                }
                                                 
                $this->cond = array ($conditions);                
                $this->Expense->recursive = 0; 
                $this->paginate['conditions'] = $this->cond;
                $expenses = $this->paginate();
                               
                if ($this->request->is('requested')){ //pregunta de eleeento
                    return $expenses;
                }else{
                    $this->set('expenses',$expenses);                
                }                 
            }
            $this->layout = 'home';           
        }
                
        public function edit($id){
        
        	$this->Expense->id = $id;
        	if ($this->request->is('get')){
        		$this->request->data = $this->Expense->read();
        		
        		$this->log($this->request->data);
        
        		$this->loadModel('Location');
        		$location = $this->Location->findById($this->request->data['Apartment']['location_id']);
        
        		$this->request->data['Location'] = $location['Location'];
        		 
        	}else{
        		//$message = $this->custoValidation($this->request->data);
        		$message = null;
        		if ($message!=null){
        			$this->Session->setFlash("<div class = 'err'>" . $message . "</div>");
        			$this->redirect(array('action' => 'edit', $this->Provider->id));
        		}
        
        		$this->request->data['Expense']['date'] = date('Y-m-d',strtotime($this->request->data['Expense']['date']));
        
        		if($this->Expense->save($this->request->data)){
        			$this->Session->setFlash("<div class = 'info'>Gasto modificado con �xito.</div>");
        			$this->redirect(array('action' => 'view'));
        		}
        	}
        	$this->layout = 'home';
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
                    
        private function findConditions($fromDate,$toDate,$location_id,$apartment_id){
            $conditions = '';
            
            if ($location_id > 0 && $apartment_id < 1){
            	
            	$this->loadModel('Apartment');  //Busca los Ids de la ubicac�n seleccionada
            	$apartmentIds = $this->Apartment->find('list', array(
        			'fields' => array('Apartment.id'),
        			'conditions' => array('Apartment.location_id' => $location_id),
        			'recursive' => 0
    			));            	
            }
            
            if ($fromDate!='' && $toDate != ''){
            		            	
                $fromDate = date('Y-m-d',strtotime($fromDate));
                $toDate = date('Y-m-d',strtotime($toDate)); 
                $conditions = "Expense.date >= " . "'" . $fromDate . "'" . 
                        " AND Expense.date <= " . "'" . $toDate . "'";
                
                if ($location_id >0 && $apartment_id > 0){ //by Date, apartment
                 	$conditions .= " AND Expense.apartment_id = '" . $apartment_id . "'";
                 	
                }else if($location_id >0 && $apartment_id < 1){ //by Location
                	
                	$conditions .= " AND Expense.apartment_id IN ('" . array_shift($apartmentIds) . "'"; //toma el primer elmento de los array
                	foreach($apartmentIds as $idApto){
                		$conditions .= ",'" . $idApto . "'";
                	}
                	$conditions .= ")";                	
                }
            } 
            
            if ($fromDate == '' && $toDate == ''){ //Without dates            
            	if ($location_id >0 && $apartment_id > 0){ //by apartment
            		$conditions .= "Expense.apartment_id = '" . $apartment_id . "'";
            
            	}else if($location_id >0 && $apartment_id < 1){ //by Location
            		 
            		$conditions .= "Expense.apartment_id IN ('" . array_shift($apartmentIds) . "'"; //toma el primer elmento de los array
            		foreach($apartmentIds as $idApto){
            			$conditions .= ",'" . $idApto . "'";
            		}
            		$conditions .= ")";
            	}
            }
            
            return $conditions;                
                
        }
        
        public function remove ($id){
        	 
        	$this->Expense->id = $id;
        	        	      	 
        	if($this->Expense->delete()){
        		$this->Session->setFlash("<div class = 'info'>Gasto se ha eliminado con �xito.</div>");
        		$this->redirect(array('action' => 'view'));
        	}
        	 
        }
        
        public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurrió un error durante la acción solicitada,
                vuelva a intentarlo, si el error persiste por favor contacte al administrador,
                ofrecemos disculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }

}
?>