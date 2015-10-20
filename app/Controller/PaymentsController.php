<?php

class PaymentsController extends AppController{
    
    public $helpers = array('Html','Form');    
    public $components = array('Session');
    
    public $paginate = array(  
            'fields' => array(
                'Payment.id', 
                'Apto.name',
            	'L.holder_name',
                'Payment.amount',
                'Payment.date',
                'Payment.from_date',
                'Payment.to_date',
            ),            
            'recursive' => 0,
            'limit' => 15,
            'joins' => array(
                    array (
                        'table' => 'leases',
                        'alias' => 'L',
                        'conditions' => array('L.id = Payment.lease_id'                            
                            )
                    ),
                    array (
                        'table' => 'apartments',
                        'alias' => 'Apto',
                        'conditions' => array('Apto.id = L.apartment_id')
                    ),
                
                                        
            ),            
            'order' => array('Payment.date' => 'DESC'),             
        );
    
    public function index(){	
	             
	if ($this->request->is('post')){                 
	    $this->redirect(array('controller' => 'payments', 'action' => 'view'));                
	             
	}else{               
	                              	
            $locations = array('-1' => '');
	    $paramsLoc = array(
	            'order' => array('Location.name' => 'ASC'));
	            	
	    $this->loadModel('Location');
	    array_push($locations, $this->Location->find('list',$paramsLoc));
	    $this->set('locations',$locations);	            	 
	}         
	$this->layout = 'home';
    }
    
    public function add($leaseId = null){
    	
        if ($this->request->is('post')){         	
             $message = null;
             
             date_default_timezone_set('America/New_York');
             $today = getdate();
             $this->request->data['Payment']['date'] = $today['year'] .
             '-' . $today['mon'] . '-' . $today['mday'];
             
             if ($message!=null){                  
                 $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                 $this->redirect(array('action' => 'add'));
                 return;
             }             
             
             if($this->Payment->save($this->request->data)){
                 $this->Session->setFlash("<div class = 'info'>Pago registrado con éxito.</div>");
                 $this->redirect(array('action' => 'print'));
             }else{
                 $this->Session->setFlash("<div class = 'err'>Hubo un error, por favor contacte al administrador.</div>");
                 $this->redirect(array('action' => 'error'));
             }
        } else {
         	
         	$this->loadModel('Lease');
         	$contract = $this->Lease->findById($leaseId);
         	$this->set('contract',$contract);         	
         	
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

            $fromDate = $data['Payment']['FromDate'];
            $toDate = $data['Payment']['ToDate'];
            $location_id = $data['Payment']['location_id'];  
            $apartment_id = $data['Payment']['apartment_id'];                

            $conditions = $this->findConditions($fromDate,$toDate,$location_id,$apartment_id);  

            $this->Session->write('conditionsExp', $conditions);

            $this->cond = array ($conditions);
            $this->paginate['conditions'] = $this->cond;  
            $payments = $this->paginate();  
            
            if ($this->request->is('requested')){   //pregunta de eleeento
                return $payments;
            }else{
                $this->set('payments',$payments);         
            }                               

        }else{

            if ($this->Session->check('conditionsExp')){                    
                $conditions = $this->Session->read('conditionsExp');                   
            }

            $this->cond = array ($conditions);                
            $this->Payment->recursive = 0; 
            $this->paginate['conditions'] = $this->cond;
            $payments = $this->paginate();

            if ($this->request->is('requested')){ //pregunta de eleeento
                return $payments;
            }else{
                $this->set('payments',$payments);                
            }                 
        }
        $this->layout = 'home';           
    }
       
    public function edit($id){            
        $this->layout = 'home';
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
            $conditions = "Payment.date >= " . "'" . $fromDate . "'" . 
                    " AND Payment.date <= " . "'" . $toDate . "'";

            if ($location_id >0 && $apartment_id > 0){ //by Date, apartment
                    $conditions .= " AND Lease.apartment_id='" . $apartment_id . "'" ;
                            //" AND Payment.lease_id = Lease.id" ;

            }else if($location_id >0 && $apartment_id < 1){ //by Location

                    $conditions .= " AND Lease.apartment_id IN ('" . array_shift($apartmentIds) . "'"; //toma el primer elmento de los array
                    foreach($apartmentIds as $idApto){
                            $conditions .= ",'" . $idApto . "'";
                    }
                    $conditions .= ")";                	
            }
        } 
        if ($fromDate == '' && $toDate == ''){ //Without dates            
            if ($location_id >0 && $apartment_id > 0){ //by apartment
                    $conditions .= "Lease.apartment_id = '" . $apartment_id . "'";

            }else if($location_id >0 && $apartment_id < 1){ //by Location

                    $conditions .= "Lease.apartment_id IN ('" . array_shift($apartmentIds) . "'"; //toma el primer elmento de los array
                    foreach($apartmentIds as $idApto){
                            $conditions .= ",'" . $idApto . "'";
                    }
                    $conditions .= ")";
            }
        }

        return $conditions;                

    }
    
    public function remove($id){
    	$this->Payment->id = $id;
    	
    	if ($this->Payment->delete()){    		
    		$this->Session->setFlash("<div class = 'info'>Pago eliminado con �xito.</div>");
    		$this->redirect(array('action' => 'view'));
    	}
    	$this->layout = 'home';    	
    }
        
     public function custoValidation($provider){
           
           $message=null;
           
           if (empty($provider['Provider']['name'])){
               $message = 'Nombre: Es un campo obligatorio.';
           //}else if(!ctype_alnum($provider['Provider']['name'])){
               //$message = 'Nombre: Sólo permite letras y/o numeros.';           
           }else if (!is_numeric($provider['Provider']['phone']) && $provider['Provider']['phone'] != ''){
               $message = 'Telefono: Ingresar unicamente números.';
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
