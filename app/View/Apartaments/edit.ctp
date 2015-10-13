<div class="edit">

    <fieldset>
        <legend>Actualizar Producto</legend>
        <?php echo $this->Form->create('Product', array ('action' => 'edit')); ?>
        <label>Nombre:</label><?php echo $this->Form->input('name', array ('label' => '')); ?>
        <label>Precio Unitario:</label><?php echo $this->Form->input('unit_price', array ('label' => ''));   ?>   
        <label>Informaci&oacuten Adicional:</label><?php echo $this->Form->input('observations', array ('label' => '')); ?>
        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
        <?php echo $this->Form->end("Actualizar Producto"); ?>
    </fieldset>
    
</div>
