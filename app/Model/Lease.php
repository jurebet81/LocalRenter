<?php

class Lease extends AppModel {
        
    public $belongsTo = array(
      'Apartment' => array(
            'className' => 'Apartment',            
            'foreignKey' => 'apartment_id'
        ),
    	'Renter' => array(
            'className' => 'Renter',            
            'foreignKey' => 'renter_id', 
        )  
    );  
    
    public $hasMany = array(
        'Payment' => array(
            'className' => 'Payment',            
        )        
    );
    
    public $validate = array(    		
    		'holder_name' => array(   
    				'rule' => 'alphaNumeric',
    				'required' => true,
    		),    		
    		'holder_identification' => array(
    				'rule' => 'alphaNumeric',
    				'required' => true,   
    				'message' => 'Ingresa solo numeros',
    		),    		
    		'holder_phone' => array(
    				'rule' => 'alphaNumeric',
    				'required' => true,
    				'message' => 'Ingresa solo numeros',
    		),
    		'amount' => array(
    				'rule' => array('money', 'left'),
    				'required' => true,
    				'message' => 'Ingresa solo numeros',
    		),    		
    		'apartment_id' => array(
    				'rule' => array('comparison', '>', 0),
    				'required' => true,
    		),    			
    		'renter_id' => array(
    				'rule' => array('comparison', '>', 0),
    				'required' => true,
    		),
    		'init_date' => array(
    				'rule' => array('date', 'ymd'),
    				'required' => true,
    		),    		
    		'end_date' => array(
    				'rule' => array('date', 'ymd'),   
    				'allowEmpty' => true,
    		),
    );
    
}
