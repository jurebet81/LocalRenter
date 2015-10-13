<?php

class Renter extends AppModel {
     public $hasMany = array(
        'Lease' => array(
            'className' => 'Lease',            
            )        
     );
     
     /*public $validate = array(
         'name' => array(
             //'rule' => '/^[ A-Za-z0-9Ã‘Ã±Ã¡Ã�Ã©Ã‰Ã­Ã�Ã³Ã“ÃºÃš_@.]*$/',
            'required' => true
         )
     );*/
}
?>