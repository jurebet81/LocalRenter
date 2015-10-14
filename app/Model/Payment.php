<?php

class Provider extends AppModel{
     public $hasMany = array(
        'Purchase' => array(
            'className' => 'Purchase',            
            )        
        );
     
     
     public $belongsTo = array(
     		'Lease' => array(
     				'className' => 'Lease',
     				'foreignKey' => 'lease_id',
     		)
     );
     
    
   
    
}
?>
