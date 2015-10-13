<?php

class Lease extends AppModel {
    
        
    
    public $belongsTo = array(
      'Apartament' => array(
            'className' => 'Apartament',            
            'foreignKey' => 'apartament_id'
        )  
    );
    
    /*public $belongsTo = array(
      'Apartament' => array(
            'className' => 'Apartament',            
            'foreignKey' => 'apartament_id', 
        )  
    );*/
    /*
    public $hasMany = array(
        'Saledetail' => array(
            'className' => 'Saledetail',            
        )        
    );*/
    
}
