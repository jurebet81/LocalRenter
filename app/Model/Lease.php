<?php

class Lease extends AppModel {
    
        
    
    public $belongsTo = array(
      'Apartament' => array(
            'className' => 'Apartament',            
            'foreignKey' => 'apartament_id'
        ),
    	'Renter' => array(
            'className' => 'Renter',            
            'foreignKey' => 'render_id', 
        )  
    );
   
   
    /*
    public $hasMany = array(
        'Saledetail' => array(
            'className' => 'Saledetail',            
        )        
    );*/
    
}
