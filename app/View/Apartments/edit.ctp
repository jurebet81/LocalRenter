<div class="edit">

    <fieldset>
     <legend>Modificar datos de Apartamento </legend>	
    	<?php echo $this->Form->create('Apartment', array ('action' => 'edit'));?>  
        <label>UBICACI&Oacute;N :</label>
            <?php echo $this->Form->input('Location.name',  array ('label' => '', 'readonly' => 'readonly'));?><br> 
        <label>NOMBRE DEL APARTAMENTO:</label>
            <?php echo $this->Form->input('name', array ('label' => '')); ?><br>        	
		<label>DIRECCI&Oacute;N:</label>
            <?php echo $this->Form->input('address', array('label' => '', 'type'=>'text'))?><br>
        <label>VALOR DE ARRENDAMIENTO:</label>
            <?php echo $this->Form->input('rent_price', array('label' => '', 'type'=>'text'))?><br>
        <label>INFORMACI&Oacute;N ADICIONAL: </label>
            <?php echo $this->Form->input('observations', array('label' => ''))?>  
    </fieldset>    
     <?php echo $this->Form->end(" Actualizar "); ?>
    
</div>
