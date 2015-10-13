<?php

class Apartament extends AppModel {
    public $name = "Apartament";
    public $displayField = 'name';
    
    public $hasMany = array(
        'Lease' => array(
            'className' => 'Lease'           
            )        
    );
    
    public $belongsTo = array(
      'Location' => array(
            'className' => 'Location',            
            'foreignKey' => 'location_id'
        )  
    );
            
    public $validate = array(           
         'name' => array(
             'rule' => '/^[ A-Za-z0-9ÑñáÁéÉíÍóÓúÚ_@.]*$/',
             'required' => true
         ),    
        'rent_price' => array(
                'rule' => 'numeric',
                'required' => true,                
                'message' => 'Numeros permitidos'
        ), 
                              
     );
  
    
}
