<?php

class Purchasedetail extends AppModel {
    
    public $belongsTo = array(
        'Purchase' => array(
            'className' => 'Purchase',            
            'foreignKey' => 'purchase_id',            
        ),
        'Product' => array(
            'className' => 'Product',            
            'foreignKey' => 'product_id', 
        ),
        
    );
    
    public $validate = array( 
        'amount' => array(
            'rule' => 'numeric',
            'required' => true,
            'message' => 'Por favor ingresar cantidad de productos'
        )
    );
       
}
