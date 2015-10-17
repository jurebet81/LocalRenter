<?php

class Payment extends AppModel{
    
     public $belongsTo = array(
     		'Lease' => array(
     				'className' => 'Lease',
     				'foreignKey' => 'lease_id',
     		)
     ); 
    
}
?>
