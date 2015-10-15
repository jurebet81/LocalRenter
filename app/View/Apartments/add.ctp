<div class="add">
    
    <?php echo $this->Form->create('Apartment') ?>
    <fieldset>
        <legend> Nuevo Apartamento </legend>
        
        <label>Locación :</label>
            <?php echo $this->Form->input('location_id',  array ('label' => ''));?><br> 
        <label>Nombre del Apartamento:</label>
            <?php echo $this->Form->input('name', array ('label' => ' ')); ?><br>
        <?php echo $this->Form->hidden('amount', array('value' => 0));?>
		<label>Direcci&oacute;n:</label>
                    <?php echo $this->Form->input('address', array('label' => ' ', 'type'=>'text'))?><br>
        <label>Valor de Renta:</label>
            <?php echo $this->Form->input('rent_price', array('label' => ' ', 'type'=>'text'))?><br>
        <label>Informaci&oacuten Adicional: </label>
            <?php echo $this->Form->input('observations', array('label' => ' '))?>  
    </fieldset>
    <?php echo $this->Form->end('Agregar Apartamento'); ?>
    
</div>