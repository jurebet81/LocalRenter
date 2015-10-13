<?php

class PurchasedetailsController extends AppController {

        public $helpers = array('Html','Form');
        public $components = array('Session');
        
        public $paginate = array(
            'limit' => 15,
            );
        
	public function index(){	
            $this->layout = 'home';	
	}    
        
        public function add($id){      
           
            
           $params = array('order' => array( //contidion is defined to find prducts in ascencdent order
               'Product.name' => 'ASC'),
           );
           
           $this->set('products', $this->Purchasedetail->Product->find('list',$params)); //find products to populate dropdown
           
           $this->Purchasedetail->Purchase->id = $id; //id of purchase is set
          
           $params = array( //condition is defined to find products depending on the current purchase
               'conditions' => array(
                   'Purchasedetail.purchase_id' => $this->Purchasedetail->Purchase->id),
           );           
           $this->set('purchasedetails', $this->Purchasedetail->find('all', $params)); //products of these purchase are fetched
           
           if ($this->request->is('get')){
               $this->request->data = $this->Purchasedetail->Purchase->read();
               $this->set('purch' , $this->request->data);           
           }else{      
               
               $message = $this->custoValidation($this->request->data); //validate data quality
               
               if ($message!=null){                  
                    $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                    $this->redirect(array('action' => 'add', 
                        $this->Purchasedetail->Purchase->id ));
                    return;
                } 
               
                if ($this->Purchasedetail->save($this->request->data)){
                    $this->Session->setFlash("<div class = 'info'>Producto ingresado.</div>");
                    $this->redirect(array('controller' => 'purchasedetails', 'action' => 'add', $this->Purchasedetail->Purchase->id));
                }                
            }
            $this->layout = 'home';
        }
        
        public function view($id){
            
            $this->Purchasedetail->recursive = 0;
                       
            $purchasedetails = $this->paginate(
                'Purchasedetail',
                array('Purchasedetail.purchase_id' => $id)
                );
            
            $this->set('purchasedetails', $purchasedetails);
            $this->Purchasedetail->Purchase->id = $id;
            
            $totalPurch = $this->Purchasedetail->find('all',  array(//retrieve the purchase total price
                'fields' => array(
                    'SUM(Purchasedetail.total_price) as total',
                ),
                'conditions' => array(
                    'Purchasedetail.purchase_id' => $id,  
                )                              
            ));
                       
            $this->request->data = $this->Purchasedetail->Purchase->read();
            $this->request->data['Purchase']['total'] = $totalPurch['0']['0']['total'];
            $this->set('purch' , $this->request->data); 
            $this->layout = 'home';
        }
        
        public function delete($idProduct = null, $idPurchase = null){            
            
            if ($this->Purchasedetail->delete($idProduct)){                
                $this->redirect(array('action' => 'add', $idPurchase));
            }            
            $this->layout = 'home';
        }
        
        private function custoValidation($newPurchaseDetails){
           
           $message=null;
           
           if ( empty($newPurchaseDetails['Purchasedetail']['amount']) 
               || $newPurchaseDetails['Purchasedetail']['amount'] == 0
                   || is_numeric($newPurchaseDetails['Purchasedetail']['amount']) == false){
               $message = 'Proveedor: Debe ingresar cantidad válida.';
               
           }else if (empty($newPurchaseDetails['Purchasedetail']['unit_price']) 
               || $newPurchaseDetails['Purchasedetail']['unit_price'] == 0
                   || is_numeric($newPurchaseDetails['Purchasedetail']['unit_price']) == false){
               $message = 'Proveedor: Debe ingresar valor unitario válido.';
                          
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