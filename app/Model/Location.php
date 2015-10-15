<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Location
 *
 * @author julian restrepo
 */
class Location extends AppModel{
    
    public $name = "Location";
    public $displayField = 'name';
    
     public $hasMany = array(
        'Apartment' => array(
            'className' => 'Apartment'           
            )        
    );
     
}
