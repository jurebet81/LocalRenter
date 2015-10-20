<div class="edit">

    <fieldset>
     <legend>Modificar datos de Apartamento </legend>	
    	<?php echo $this->Form->create('Apartment', array ('action' => 'edit'));?> 
    	
    <table>
    	<tr>
	    	<td>
	        <label>UBICACI&Oacute;N :</label>
	            <?php echo $this->Form->input('Location.name',  array ('label' => '', 'readonly' => 'readonly'));?></td> 
	        <td>    
	        <label>NOMBRE DEL APARTAMENTO:</label>
	            <?php echo $this->Form->input('name', array ('label' => '')); ?></td>
	            
        </tr> 
        <tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>  
        <tr>
	    	<td>         	
			<label>DIRECCI&Oacute;N:</label>
            	<?php echo $this->Form->input('address', array('label' => '', 'type'=>'text'))?></td>
            <td>
        	<label>VALOR DE ARRENDAMIENTO:</label>
            	<?php echo $this->Form->input('rent_price', array('label' => '', 'type'=>'text'))?></td>
        </tr>
        <tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>  
    </table>    
        <label>INFORMACI&Oacute;N ADICIONAL: </label>
            <?php echo $this->Form->input('observations', array('label' => ''))?>  
            <?php echo $this->Form->end(" Actualizar "); ?>
    </fieldset>    
     
    
</div>
