<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class LeasesController extends AppController {
        
        public $helpers = array('Html','Form');
        public $components = array('Session','RequestHandler');
        public $cond = array();             
        
        public $months = array('-1' => '', '1' => 'Enero','2' => 'Febrero','3' => 'Marzo','4' => 'Abril','5' => 'Mayo','6' => 'Junio',
        		'7' => 'Julio', '8' => 'Agosto','9' => 'Septiembre','10' => 'Octubre','11' => 'Noviembre','12' => 'Diciembre');

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
                       
                if ($this->Lease->save($this->request->data)){
                    //$this->Session->setFlash("<div class = 'info'>Contrato ingresado correctamente, Resumen del contrato</div>");
                    $this->redirect(array('controller' => 'Leases', 'action' => 'printContract', $this->lease->id));
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
              
        public function printContract($id = null){
        	
        	//$contract = array("contrato" => "todo el texto que implica el contrato");
        	
        	$pathFile = WWW_ROOT . DS . 'files' . DS . 'Contract_template_2.txt';
        	$handle = fopen($pathFile, "r");
        	$content = fread($handle,filesize($pathFile));
        	
        	$data = array('á' => '&aacute;','é' => '&eacute;','í' => '&iacute;','ó' => '&oacute;','ú' => '&uacute;',
        		'ñ' => '&ntilde;', '“' => '&#34', '”' => '&#34', '–' => '&#45');
        	$newData = strtr($content, $data);
        	//fwrite($handle,$newData);
        	$this->set("contrato", $newData);
        	fclose($handle);
        	
        	$this->layout = 'printLay';
        	
            /*$pathFile = WWW_ROOT . DS . 'files' . DS . 'Contract_template.txt';
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
                
            $this->layout = 'home';*/
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

        public function edit($id){
        
        	$this->Lease->id = $id;
        	if ($this->request->is('get')){
        		$this->request->data = $this->Lease->read();
        
        		$this->loadModel('Location');
        		$location = $this->Location->findById($this->request->data['Apartment']['location_id']);
        
        		$this->request->data['Location'] = $location['Location'];
        		 
        	}else{
        		
        		$this->request->data['Lease']['end_date'] = date('Y-m-d',strtotime($this->request->data['Lease']['end_date']));
        
        		if($this->Lease->save($this->request->data)){
        			$this->Session->setFlash("<div class = 'info'>Contrato actualizado con ï¿½xito.</div>");
        			$this->redirect(array('action' => 'view'));
        		}
        	}
        	$this->layout = 'home';
        }
        
        public function profits(){
        
        	if ($this->request->is('post')){
        		$this->Session->write('ProfitFilters', $this->request->data);
        		$this->redirect(array('action' => 'profitdetails'));
        
        	}else{
        		$year = 2015;
        		$years = array('-1' => '');
        		$counter = 0;
        
        		while ($year<=date("Y") && $counter++ <= 5){
        			$years[$year] = $year;
        			$year++;
        			$counter++;
        		}
        		
        		$locations = array('-1' => '');
        		$paramsLoc = array('order' => array( //contidion is defined to find prducts in ascencdent order
        				'Location.name' => 'ASC'),
        		);
        		$this->loadModel('Location');
        		array_push($locations,$this->Location->find('list',$paramsLoc));
        		
        		$this->set('locations', $locations);
        		$this->set('years',$years);
        		$this->set('months',$this->months);
        	}
        
        	$this->layout = 'home';
        }

        public function profitdetails(){
        
        	$profitdetails = array();
        
        	if ($this->Session->check('ProfitFilters')){
        		$filters = $this->Session->read('ProfitFilters');
        	}else{
        		$this->redirect(array('action' => 'profits'));
        	}
        	        	        	
        	$year = $filters['Lease']['year'];
        	$month = $filters['Lease']['month'];
        	$location_id = $filters['Lease']['location_id'];
        	$apartment_id = $filters['Lease']['apartment_id'];
        
        	
        	if ($year > 2014 && $month > 0)  {        
        		$profitdetail = $this->getProfitByMonth($year,$month,$location_id,$apartment_id);
        		array_push($profitdetails, $profitdetail);        
        	}else if ($year > 2014 && $month < 1) {
        		for ($imonth=1;$imonth<13;$imonth++){
        			$profitdetail = $this->getProfitByMonth($year,$imonth,$location_id,$apartment_id);
        			array_push($profitdetails, $profitdetail);
        		}
        	}
        	        
        	$this->set('profits',$profitdetails);
        	
        	$this->layout = 'home';
        }
        
        public function getProfitByMonth($year,$month,$location_id,$apartment_id){
        
        	$i_date = strtotime($year . "-" . $month . "-01");
        	$l_date = strtotime("+1 month",$i_date);
        
        	$last_date = date('Y-m-d',strtotime("-1 day",$l_date));
        	$init_date = date('Y-m-d',$i_date);
        
        	$queryPayment = "SELECT SUM(p.amount) as Total FROM payments p, leases l "
        			. "WHERE p.lease_id = l.id AND "
                         . "p.date between " . "'" . $init_date . "' and '" . $last_date . "'";
        
        	$queryExpense = "SELECT SUM(e.amount) as Total FROM expenses e "
        			. "WHERE e.date between "
        					. "'" . $init_date . "' and '" . $last_date . "'";
        
        	if ($location_id>0 && $apartment_id>0){
        		$queryPayment .= " AND l.apartment_id = " . $apartment_id;
        		$queryExpense .= " AND e.apartment_id = " . $apartment_id;
                }else if($location_id>0 && $apartment_id<1){
                    $this->loadModel('Apartment');  //Busca los Ids de la ubicacï¿½n seleccionada
                    $apartmentIds = $this->Apartment->find('list', array(
        			'fields' => array('Apartment.id'),
        			'conditions' => array('Apartment.location_id' => $location_id),
        			'recursive' => 0
                    )); 
                    
                    $firstid = array_shift($apartmentIds);//toma el primer elmento de los array
                    $queryPayment .= " AND l.apartment_id IN ('" . $firstid . "'"; 
                    $queryExpense .= " AND e.apartment_id IN ('" . $firstid . "'"; 
                    
                    foreach($apartmentIds as $idApto){
                	$queryPayment .= ",'" . $idApto . "'";
                        $queryExpense .= ",'" . $idApto . "'";
                    }
                    $queryPayment .= ")";  
                    $queryExpense .= ")";
                }
        
        	$paymentArray = $this->Lease->query($queryPayment);
        	$payment = $paymentArray[0][0]['Total'];
        	$expenseArray =  $this->Lease->query($queryExpense);
        	$expense = $expenseArray[0][0]['Total'];
        
        	if ($payment==''){
        		$payment = 0;
        	}
        	if ($expense==''){
        		$expense = 0;
        	}
        
        	$profitdetail = array($this->months[$month] . "/" . $year =>
        			array('Payments' => $payment, 'Expenses' => $expense, 'Profits' => $payment - $expense));
        
        	return $profitdetail;
        }       
        
        
        private function findConditions($fromDate,$toDate,$client_id){
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
        		$this->Session->setFlash("<div class = 'info'>Contrato cerrado con ï¿½xito.</div>");
        		$this->redirect(array('action' => 'view'));
        	}    

        	$this->layout = 'home';
        	
        }        
        
        public function error(){
            $this->Session->setFlash("<div class = 'err'>OcurriÃ³ un error durante la acciÃ³n solicitada,
                vuelva a intetarlo, si el error persiste por favor contacte al administrador,
                pedimos dusculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }

}
?>