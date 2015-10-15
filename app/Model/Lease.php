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
    
}
