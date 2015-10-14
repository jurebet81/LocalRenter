<div class="edit">

    <fieldset>
        <legend>Actualizar Proveedor</legend>
        <?php echo $this->Form->create('Provider', array ('action' => 'edit'));?>
        <label>Nombre:</label><?php echo $this->Form->input('name', array ('label' => ''));?> <br>
        <label>Tel&eacute;fono:</label><?php echo $this->Form->input('phone', array ('label' => ''));?> <br>
        <label>Direcci&oacute;n:</label><?php echo $this->Form->input('address', array ('label' => '')); ?> <br>
        <label>Informaci&oacute;n Adicional:</label><?php echo $this->Form->input('observations', array ('label' => ''));?> <br>
        <?php echo $this->Form->input('id', array('type' => 'hidden'));   ?>
    </fieldset>
    
        <?php echo $this->Form->button(' Volver ', array ('alt' =>'CakePHP', 'url' =>
             array('controller' => 'provider', 'action' => 'view')));  ?>  
        <?php echo $this->Form->end(" Actualizar "); ?>
    
</div>