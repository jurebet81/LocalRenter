<?php

class SaledetailsController extends AppController {
    
        public $components = array('Session','RequestHandler');//preticiones ajax manejadro de peticiones        
        public $helpers = array('Html','Form','Js' => array('Jquery'));
        
        public $paginate = array(            
            'order' => array('Product.name' => 'asc'),
            'limit' => 15,
        );
        
	public function index(){	
            $this->layout = 'home';	
	}    
        
        public function add($id){
            $params = array('order' => array( //contidion is defined to find prducts in ascencdent order
                'Product.name' => 'ASC'),
            );
            $this->set('products', $this->Saledetail->Product->find('list',$params)); //find products to populate dropdown            
            
            $this->Saledetail->Sale->id = $id; //id of purchase is set
            $params = array( //condition is defined to find products depending on the current purchase
                'conditions' => array(
                    'Saledetail.sale_id' => $this->Saledetail->Sale->id),
            );
            
            $this->set('saledetails', $this->Saledetail->find('all', $params)); //products of these purchase are fetched

            if ($this->request->is('get')){
                $this->request->data = $this->Saledetail->Sale->read();
                $this->set('sal' , $this->request->data);           
            }else{       
                try{
                    
                    $message = $this->custoValidation($this->request->data);
                    if ($message!=null){                  
                        $this->Session->setFlash("<div class = 'err' >" . $message . "</div>");
                        $this->redirect(array('action' => 'add', $this->Saledetail->Sale->id));
                        return;
                    } 
                                       
                    if ($this->Saledetail->save($this->request->data)){
                        $this->Session->setFlash("<div class = 'info'>Producto ingresado.</div>");
                        $this->redirect(array('controller' => 'saledetails', 'action' => 'add', $this->Saledetail->Sale->id));
                    }
                }                
                catch (Exception $e){                    
                    if ($e->getCode() == 22003){ //code returned bt db trigger cos there're not enough products 
                        $this->Session->setFlash("<div class = 'err'>Cantidad no disponible para ese producto. </div>");                        
                    }else{
                        $this->Session->setFlash("<div class = 'err'>Hubo un error al ingresar el producuto, contacte al administrador para solucionarlo. </div>" );
                    }
                    $this->redirect(array('controller' => 'saledetails', 'action' => 'add', $this->Saledetail->Sale->id));                        
                }                          
             }
             $this->layout = 'home';
        }
        
         public function view($id){
            $this->Saledetail->recursive = 0;
            $this->log("hola " );
                       
            $saledetails = $this->paginate(
                'Saledetail',
                array('Saledetail.sale_id' => $id)
                );
            
            $this->Saledetail->Sale->id = $id; //id of purchase is set
            
            $totalSale = $this->Saledetail->find('all',  array(//retrieve the purchase total price
                'fields' => array(
                    'SUM(Saledetail.total_price) as total',
                ),
                'conditions' => array(
                    'Saledetail.sale_id' => $id,  
                )                              
            ));         
                              
            
            $this->set('saledetails',  $saledetails);
            $this->request->data = $this->Saledetail->Sale->read();
            $this->request->data['Sale']['total'] = $totalSale['0']['0']['total'];
            $this->set('sal' , $this->request->data);                       
            
            $this->layout = 'home';
        }
        
        public function delete($idProduct = null, $idSale = null){            
            
            if ($this->Saledetail->delete($idProduct)){                
                $this->redirect(array('action' => 'add', $idSale));
            }            
            $this->layout = 'home';
        }
        
        public function custoValidation($newSaleDetail){
           
           $message=null; 
           if (empty($newSaleDetail['Saledetail']['product_id'])){
               $message = 'Producto: Debe seleccionar un producto.';
           }else if (empty($newSaleDetail['Saledetail']['amount'])){
               $message = 'Cantidad: Es un campo obligatorio.';
           }else if(!is_numeric($newSaleDetail['Saledetail']['amount']) || $newSaleDetail['Saledetail']['amount'] < 0){
               $message = 'Cantidad: Ingresar cantidad válida.';         
           }           
           return $message;            
        }
        
        public function printReceipt($idSale = null){ 
            
            $this->loadModel('Storedetail'); //Se obtiene data del otro controlador (detalles de la tienda)
            $storedetail = $this->Storedetail->find('first');
            $this->set('storedetail',$storedetail);    
                 
                      
            $this->Saledetail->Sale->id = $idSale; //id of purchase is set
            $params = array( //condition is defined to find products depending on the current purchase
                'conditions' => array(
                    'Saledetail.sale_id' => $this->Saledetail->Sale->id),
            );
            
            $this->set('saledetails', $this->Saledetail->find('all', $params)); //products of these purchase are fetched
            $sale = $this->Saledetail->Sale->read();
            $this->set('sale' , $sale);   //se obtiene detalles generales de la venta
            
            $this->loadModel('Client'); //se 
            $clientParams = array( //condition is defined to find products depending on the current purchase
                'conditions' => array(
                    'Client.id' => $sale['Sale']['client_id']),
            );
            $client = $this->Client->find('first',$clientParams); //se obtiene detalles del cliente
            $this->set('client',$client);
            
            $this->layout = 'printLay';
        }
        
         public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurrió un error durante la acción solicitada,
                vuelva a intetarlo, si el error persiste por favor contacte al administrador,
                pedimos dusculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }

}
?>