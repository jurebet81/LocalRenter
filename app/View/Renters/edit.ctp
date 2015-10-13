<div class="edit">

    <fieldset>
        <legend>Actualizar Arrendatario</legend>
        
        <?php echo $this->Form->create('Renter', array ('action' => 'edit')); ?>
        <label>Nombre Completo:</label>
            <?php echo $this->Form->input('name', array ('label' => '')); ?> <br>
        <label>Tel&eacutefono:</label>
            <?php echo $this->Form->input('identification', array ('label' => ''));?> <br>                
        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
    </fieldset>
        <?php //echo $this->Form->button(' Volver ', array ('alt' =>'CakePHP', 'url' => array('action' => 'view'))); ?>
        <?php echo $this->Form->end(" Actualizar "); ?>
</div>

