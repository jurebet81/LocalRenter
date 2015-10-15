<?php

class PaymentsController extends AppController{
    
    public $helpers = array('Html','Form');    
    public $components = array('Session');
    
    public $paginate = array(
            'limit' => 15,
            'order' => array('Payment.date' => 'asc'),
        );
    
    public function index(){
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
    	
        $this->Provider->recursive = 0; 
        $providers = $this->paginate();
        if ($this->request->is('requested')){ //pregunta de eleeento
            return $providers;
        }else{
            $this->set('providers',$providers);                
        } 
        $this->layout = 'home';
   }
       
   public function edit($id){            
        $this->Provider->id = $id;
        if ($this->request->is('get')){
            $this->request->data = $this->Provider->read();
             
        }else{
             $message = $this->custoValidation($this->request->data);
             if ($message!=null){                  
                  $this->Session->setFlash("<div class = 'err'>" . $message . "</div>");
                  $this->redirect(array('action' => 'edit', $this->Provider->id));                    
             }  
               
             if($this->Provider->save($this->request->data)){
                $this->Session->setFlash("<div class = 'info'>Proveedor actualizado con éxito.</div>");
                $this->redirect(array('action' => 'view'));
            }
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
