<?php
class LocationsController extends AppController {
    
        public $helpers = array('Html','Form','Js' => array('Jquery'));
        public $components = array('Session','RequestHandler'); 
               
	public function index(){	
            //$this->layout = 'home';	
	}
	
        public function add(){           
            
        }        
        
        public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurrió un error durante la acción solicitada,
                vuelva a intetarlo, si el error persiste por favor contacte al administrador,
                pedimos dusculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }
}
?>