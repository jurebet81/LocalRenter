<?php

class Lease extends AppModel {
        
    public $belongsTo = array(
      'Apartament' => array(
            'className' => 'Apartament',            
            'foreignKey' => 'apartament_id'
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
