<?php

class Provider extends AppModel{
     public $hasMany = array(
        'Purchase' => array(
            'className' => 'Purchase',            
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
