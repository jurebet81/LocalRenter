<?php

class Renter extends AppModel {
     public $hasMany = array(
        'Lease' => array(
            'className' => 'Lease',            
            )        
     );
     
     public $validate = array(
         'name' => array(            
            'required' => true
         ),
     	'identification' => array(
     		'rule' => 'numeric',
     		'required' => true,
     	),
     );
}
?>