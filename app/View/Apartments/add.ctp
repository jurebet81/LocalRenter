<div class="add">
    
    <?php echo $this->Form->create('Apartment') ?>
    <fieldset>
    <legend> Nuevo Apartamento </legend>  
    <table>
    <tr>
    	<td>              
        <label>UBICACI&Oacute;N :</label>
            <?php echo $this->Form->input('location_id',  array ('label' => ''));?> </td>
        <td> 
        <label>NOMBRE DEL APARTAMENTO:</label>
            <?php echo $this->Form->input('name', array ('label' => ' ')); ?></td>       
	 </tr>	
	 <tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>   
	 <tr>
	 	<td> 
		<label>DIRECCI&Oacute;N:</label>
                    <?php echo $this->Form->input('address', array('label' => ' ', 'type'=>'text'))?></td>
        <td> 
        <label>VALOR DE ARRENDAMIENTO:</label>
            <?php echo $this->Form->input('rent_price', array('label' => ' ', 'type'=>'text'))?></td>
     </tr>      
     <tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>      
    </table>
    <label>INFORMACI&Oacute;N ADICIONAL: </label>
            <?php echo $this->Form->input('observations', array('label' => ' '))?> 
     <?php echo $this->Form->end('Agregar Apartamento'); ?>
    </fieldset>
   
    
</div>