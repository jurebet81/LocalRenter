<?php


class UsersController extends AppController{
    
    public $components = array(
    'Auth' => array(
        'authenticate' => array(
            'Form' => array(
                'passwordHasher' => array(
                    'className' => 'Simple',
                    'hashType' => 'sha1'
                    )
                )
            )
        )
    );
    
      public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('Usuario no puede ser guardado, intente de nuevo.')
            );
        }
    }
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout');
    }
       
    public function login(){
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
        $this->Session->setFlash(__("<div class = 'errorLogin' >Usuario o contraseña inválidos, intende de nuevo. </div>"));
        }
        $this->layout = 'loginLay';
    }
    
     public function logout() {
        return $this->redirect($this->Auth->logout());
    }
     public function error(){
            $this->Session->setFlash("<div class = 'err'>Ocurrió un error durante la acción solicitada,
                vuelva a intetarlo, si el error persiste por favor contacte al administrador,
                pedimos dusculpas por las molestias ocasionadas.</div>");
            $this->layout = 'home';
        }
}
?>
