<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {      
      public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'                
            )
        )
    );
      
    
}
