<?php

class Saledetail extends AppModel {
    
    public $belongsTo = array(
        'Sale' => array(
            'className' => 'Sale',            
            'foreignKey' => 'sale_id',            
        ),
        'Product' => array(
            'className' => 'Product',            
            'foreignKey' => 'product_id', 
        )
    );
    
    public $validate = array(
            'amount' => array(
                'rule' => 'numeric',
                'required' => true,                
                'message' => 'Sólo números permitidos'
            ),           
                              
        );
       
}
