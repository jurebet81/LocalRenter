<?php

class Apartment extends AppModel {
    public $name = "Apartment";
    public $displayField = 'name';
    
    public $hasMany = array(
        'Lease' => array(
            'className' => 'Lease'           
         ),
    	'Expense' => array(
    			'className' => 'Expense'
    	)
    );
    
   
    public $belongsTo = array(
      'Location' => array(
            'className' => 'Location',            
            'foreignKey' => 'location_id'
        )  
    );
            
    /*public $validate = array(           
         'name' => array(
             'rule' => '/^[ A-Za-z0-9Ã‘Ã±Ã¡Ã�Ã©Ã‰Ã­Ã�Ã³Ã“ÃºÃš_@.]*$/',
             'required' => true
         ),    
        'rent_price' => array(
                'rule' => 'numeric',
                'required' => true,                
                'message' => 'Numeros permitidos'
        ), 
                              
     );*/
  
    
}
