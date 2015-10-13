
  <?php echo $this->Form->create('User'); ?>

  <p>
    <label for="user">USUARIO</label>
    <?php echo $this->Form->input('username', array('label' => '')); ?>
  </p>
  <p>
    <label for="password">CONTRASEÑA</label>
   <?php echo $this->Form->input('password', array('label' => ''));?>
  </p>  

  <p class="p-container">    
    <?php echo $this->Form->end(__('Ingresar')); ?>
  </p>
  
