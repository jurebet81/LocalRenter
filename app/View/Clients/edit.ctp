<div class="edit">

    <fieldset>
        <legend>Actualizar Cliente</legend>
        
        <?php echo $this->Form->create('Client', array ('action' => 'edit')); ?>
        <label>Nombre:</label>
            <?php echo $this->Form->input('name', array ('label' => '')); ?> <br>
        <label>Tel&eacutefono:</label>
            <?php echo $this->Form->input('phone', array ('label' => ''));?> <br>
        <label>Direcci&oacuten:</label>
            <?php echo $this->Form->input('address', array ('label' => '')); ?> <br>
        <label>Informaci&oacuten Adicional:</label>
            <?php echo $this->Form->input('observations', array ('label' => '')); ?>         
        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
    </fieldset>
        <?php //echo $this->Form->button(' Volver ', array ('alt' =>'CakePHP', 'url' => array('action' => 'view'))); ?>
        <?php echo $this->Form->end(" Actualizar "); ?>
</div>

