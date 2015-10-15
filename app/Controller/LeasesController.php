<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class LeasesController extends AppController {
        
        public $helpers = array('Html','Form');
        public $components = array('Session','RequestHandler');
        public $cond = array();             

        public $paginate = array(  //join for retrieve sales details and prices together...
        		'fields' => array(
        				'Lease.id',
        				'Lease.holder_name',
        				'Apto.name',        				
        				'Lease.amount',
        				'Lease.init_date',
        				'Lease.last_payment_date',
        		),        		
        		'recursive' => 0,
        		'limit' => 15,
        		'joins' => array(        				
        				array (
        						'table' => 'apartments',
        						'alias' => 'Apto',
        						'conditions' => array('Apto.id = Lease.apartment_id')
        				),        
        		),
        		'order' => array('Lease.last_payment_date' => 'ASC'),
        );
        
            
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
                $this->request->data['Lease']['init_date'] = date('Y-m-d',strtotime($this->request->data['Lease']['init_date']));  
                $this->request->data['Lease']['last_payment_date'] = $this->request->data['Lease']['init_date'];
                
                if ($this->request->data['Lease']['end_date']!= null){
                	$this->request->data['Lease']['end_date'] = date('Y-m-d',strtotime($this->request->data['Lease']['end_date']));
                }
                
                //$message = $this->custoValidation($this->request->data);
                $message = null;
                if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                    $this->redirect(array('action' => 'add'));
                    return;
                } 
                               
                if ($this->Lease->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Contrato ingresado correctamente, Resumen del contrato</div>");
                    $this->redirect(array('controller' => 'Leases', 'action' => 'download', $this->lease->id));
                }  
            }else {
                
            	$locations = array('-1' => '');
                $paramsLoc = array(                    
                    'order' => array( //contidion is defined to find apartamens in ascencdent order
                        'Location.name' => 'ASC'));
                
                $this->loadModel('Location');
                array_push($locations, $this->Location->find('list',$paramsLoc));
                $this->set('locations',$locations);
                
                $paramsRen = array('order' => array( //contidion is defined to find providers in ascencdent order
                		'Renter.name' => 'ASC'),
                );
                $this->set('renters', $this->Lease->Renter->find('list',$paramsRen));
                
                
            }
            $this->layout = 'home';
        }
        
        
        public function download($id = null){
        	
            $pathFile = WWW_ROOT . DS . 'files' . DS . 'Contract_template.txt';
            $handle = fopen($pathFile, "r");
            $content = fread($handle,filesize($pathFile));
            
            $data = array("inquilino_name" => "Julian Inquilino","iniquilino_identification" => '1027884448',
                'apartment_name' => 'apto de en lado', 'apartment_location' => 'Andes');
            $newData = strtr($content, $data);
            
            $pathFile2 = WWW_ROOT . DS . 'files' . DS . 'Contract.txt';
            $pathFile3 = WWW_ROOT . DS . 'files' . DS . 'Contract' . "inquilino" . ".doc";
            $handle2 = fopen($pathFile2, "c");
            fwrite($handle2,$newData);
            fclose($handle2);
            rename($pathFile2,$pathFile3);
            
            $this->viewClass = 'Media';    
            $params = array(
                'id'        => 'Contractinquilino.doc',
                'name'      => 'Contractinquilino',
                'extension' => 'doc',
                'mimeType'  => array(
                    'doc' => 'application/msword'
                ),
                'path'      => 'files' . DS
            );
            $this->set($params);
                
            $this->layout = 'home';
        }
        
        public function fetchApartments($id = null){             
            
            $paramsApar = array(
                    'conditions' => array(
                        'Apartment.available' => 'si',
                        'Apartment.location_id' => $id),
                    'order' => array( //contidion is defined to find apartamens in ascencdent order
                        'Apartment.name' => 'DESC'));   
                $this->set('apartments', $this->Lease->Apartment->find('all',$paramsApar));
                
        }
        
        public function view(){           
            
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
            	
            	$paramsLease = array(
            			'conditions' => array(
            					'Lease.status' => 'Activo'));
            	
                $this->paginate['conditions'] =  array('Lease.status' => 'Activo');
                             
                $this->Lease->recursive = 0;                 
                $leases = $this->paginate();                               
                if ($this->request->is('requested')){ //pregunta de eleeento
                    return $leases;
                }else{
                    $this->set('leases',$leases);                
                }   
                           
            }
            $this->layout = 'home';             
        }
	        
        public function custoValidation($newSale){
           
           $message=null;
           
           if (($newSale['Sale']['client_id']) == null){
               $message = 'Cliente: Debe seleccionar un cliente.';
           } else if (date('Y',strtotime($newSale['Sale']['date'])) < 2010){
               $message = 'Fecha: Debe ingresar una fecha v√°lida.';
           }      
           return $message;            
        }
        
        public function edit($id){
        	 
        	$this->Lease->id = $id;
        	if ($this->request->is('get')){
        		$this->request->data = $this->Lease->read();   
        		
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
        		
        		$this->request->data['Lease']['end_date'] = date('Y-m-d',strtotime($this->request->data['Lease']['end_date']));
        		
        		if($this->Lease->save($this->request->data)){
        			$this->Session->setFlash("<div class = 'info'>Contrato actualizado con Èxito.</div>");
        			$this->redirect(array('action' => 'view'));
        		}
        	}
        	$this->layout = 'home';
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
        
        public function close ($id){
        	
        	date_default_timezone_set('America/New_York');
        	$today = getdate();
        	$date = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
        	        	
        	$this->Lease->read('id', $id); 
        	$this->Lease->set(array(
        			'status' => 'Inactivo',    //CLose lease.  
        			'end_date' => $date,			
        	));
        	
        	if($this->Lease->save()){
        		$this->Session->setFlash("<div class = 'info'>Contrato cerrado con Èxito.</div>");
        		$this->redirect(array('action' => 'view'));
        	}        	
        	
        }        
        public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurri√≥ un error durante la acci√≥n solicitada,
                vuelva a intetarlo, si el error persiste por favor contacte al administrador,
                pedimos dusculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }

}
?>