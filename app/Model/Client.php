<?php

class Client extends AppModel {
     public $hasMany = array(
        'Sale' => array(
            'className' => 'Sale',            
            )        
     );
     
     public $validate = array(
         'name' => array(
             'rule' => '/^[ A-Za-z0-9ÑñáÁéÉíÍóÓúÚ_@.]*$/',
             'required' => true
         )
     );
}
?>