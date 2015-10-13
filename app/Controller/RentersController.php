<?php

class RentersController extends AppController {

        public $helpers = array('Html','Form');
        public $components = array('Session');
                
        public $paginate = array(
            'limit' => 15,
            'order' => array('Client.name' => 'asc'),
        );
        
	public function index(){	
            $this->layout = 'home';	
	}
        
        public function add(){       
             
            if ($this->request->is('post')){                
               
                $message = $this->custoValidation($this->request->data);
                if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                    $this->redirect(array('action' => 'add'));                    
                }                            
                
                if($this->Renter->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Arrendador guardado con éxito.</div>");
                    $this->redirect(array('action' => 'add'));
                }else{
                    $this->Session->setFlash("<div class = 'err'>Hubo un error, por favor contacte al administrador.</div>");
                    $this->redirect(array('action' => 'error'));
                }
            }            
            $this->layout = 'home';	
	}
        
        public function view(){
            $this->Client->recursive = 0; 
            $clients = $this->paginate();
            if ($this->request->is('requested')){ //pregunta de eleeento
                return $clients;
            }else{
                $this->set('clients',$clients);                
            } 
            $this->layout = 'home';
       }
            
       public function edit($id){    
                        
            $this->Client->id = $id;
            if ($this->request->is('get')){
                $this->request->data = $this->Client->read();
                
            }else{
                
               $message = $this->custoValidation($this->request->data);
               if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                    $this->redirect(array('action' => 'edit', $this->Client->id));                    
               }  
                
                if($this->Client->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Cliente actualizado con éxito.</div>");
                    $this->redirect(array('action' => 'view'));
                }
            }
            $this->layout = 'home';
       }
       
       public function custoValidation($client){
           
           $message=null;
           
           if (empty($client['Client']['name'])){
               $message = 'Nombre: Es un campo obligatorio.';
           //}else if (!ctype_alnum($client['Client']['name'])){
               //$message = 'Nombre: Sólo permite letras y/o números.';           
           }else if (!is_numeric($client['Client']['phone']) && $client['Client']['phone'] != ''){
               $message = 'Teléfono: Ingresar unicamente números.';
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