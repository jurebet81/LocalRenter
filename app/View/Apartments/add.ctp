<div class="add">
    
    <?php echo $this->Form->create('Apartment') ?>
    <fieldset>
        <legend> Nuevo Apartamento </legend>        
        <label>UBICACI&Ocute;N :</label>
            <?php echo $this->Form->input('location_id',  array ('label' => ''));?><br> 
        <label>NOMBRE DEL APARTAMENTO:</label>
            <?php echo $this->Form->input('name', array ('label' => ' ')); ?><br>        
		<label>DIRECCI&Oacute;N:</label>
                    <?php echo $this->Form->input('address', array('label' => ' ', 'type'=>'text'))?><br>
        <label>VALOR DE ARRENDAMIENTO:</label>
            <?php echo $this->Form->input('rent_price', array('label' => ' ', 'type'=>'text'))?><br>
        <label>INFORMACI&Oacute;N ADICIONAL: </label>
            <?php echo $this->Form->input('observations', array('label' => ' '))?>  
    </fieldset>
    <?php echo $this->Form->end('Agregar Apartamento'); ?>
    
</div>