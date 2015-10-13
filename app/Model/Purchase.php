<?php

class Purchase extends AppModel {
    
    public $hasMany = array(
        'Purchasedetail' => array(
            'className' => 'Purchasedetail',            
        )        
    );
    
    public $belongsTo = array(
      'Provider' => array(
            'className' => 'Provider',            
            'foreignKey' => 'provider_id', 
        )  
    );
    
    public $validate = array( 
        'id_invoice' => array(
            'rule' => 'alphaNumeric',
            'required' => true,
            'message' => 'Por favor ingresar número de factura.'
        ),
        
        /*'date_requested' => array(
            'date' => array(                
                'rule' => array('date', 'ymd'),
                'message' => 'Por favor ingrese fecha.',
            ),
        ),*/
         'date_delivered' => array(
            'date' => array(                
                'rule' => array('date', 'ymd'),
                'message' => 'Por favor ingrese fecha.',
            ),
        ),
    );
}
