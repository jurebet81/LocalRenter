<div class="add">    
     
    <?php echo $this->Form->create('Expense', array ('action' => 'edit')) ?>
     <fieldset>
        <legend> Modificar Gasto </legend>           
        <table> 
        <tr>    
	        <td><label>UBICACI&Oacute;N: </label>
	            <?php echo $this->Form->input('Location.name', array ('type'=>'text','label' => '','readonly' => 'readonly'));?> </td>        
	        <td><label>APARTAMENTO:</label>
	            <?php echo $this->Form->input('Apartment.name', array ('type'=>'text','label' => '','readonly' => 'readonly')); ?> </td> 
	    </tr> 
	    <tr id = "separator"> <td> <label></label></td> <td> <label> </label> </td> </tr>
	    <tr>
	        <td><label>VALOR : </label>
	            <?php echo $this->Form->input('amount', array ('label' => ''));?> </td>           
	        <td><label>FECHA: </label>
	            <?php echo $this->Form->input('date', array(
	                'class'=>'datepicker', 'type'=>'text','label'=>'','readonly' => 'readonly' )); ?> </td>    
         </tr>
         <tr id = "separator"> <td> <label></label></td> <td> <label> </label> </td> </tr>
         </table>       
        <label>DESCRIPCI&Oacute;N DEL GASTO:</label>
        <?php echo $this->Form->input('description', array ('label' => '')); ?>
        
         <?php echo $this->Form->end('Modificar Gasto'); ?>
    </fieldset>
</div>

 <script language="javascript" type="text/javascript">	  
           
             $(document).ready(function() {                 
                $( "input.datepicker" ).datepicker({                    
                    dateFormat: 'yy-mm-dd',
                    yearRange: "-100:+50",
                    changeMonth: true,
                    changeYear: true,
                    constrainInput: false,
                    showOn: 'both',
                    buttonImage: "/LocalRenter/img/calendar.png",
                    buttonImageOnly: true                                        
                });                
        });
</script>