<div class="add">    
     
    <?php echo $this->Form->create('Lease') ?>
    <fieldset>
        <legend> Contrato de Arrendamiento </legend>       
        
        	<label>NOMBRE DEL INQUILINO:</label>
            	<?php echo $this->Form->input('holder_name',  array ('label' => ''));?><br>
        <table>
        <tr>    	
        	<td><label>N&Uacute;MERO DE C&Eacute;DULA: </label>
            	<?php echo $this->Form->input('holder_identification',  array ('label' => ''));?>
            </td>
            <td><label>TEL&Eacute;FONO</label>
            	<?php echo $this->Form->input('holder_phone',  array ('label' => ''));?>
            </td>
       	</tr>
       	<tr id = "separator"> <td> <label></label></td> <td> <label> </label> </td> </tr>
       	<tr>
        	<td><label>UBICACI&Oacute;N:</label>
            	<?php echo $this->Form->input('location_id',  array ('label' => ''));?></td>
        	<td><label>APARTAMENTO A TOMAR:</label>
            	<?php echo $this->Form->input('apartment_id',  array ('label' => ''));?></td> 
        </tr>
        <tr> <td> <label> </label></td> <td> <label> </label> </td> </tr> 
         <tr>	
        	<td><label>VALOR DE ARRIENDO:</label>
            	<?php echo $this->Form->input('amount',  array ('label' => ''));?></td>  
        	<td><label>ARRENDATARIO:</label>
            	<?php echo $this->Form->input('renter_id',  array ('label' => ''));?></td>
        </tr> 
        <tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>    	
        <tr>     
        	<td><label>FECHA INICIO DE CONTRATO:</label>
            	<?php echo $this->Form->input('init_date', array('class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly' )); ?></td> 
        	<td><label>FECHA FIN DE CONTRATO:</label>
            	<?php echo $this->Form->input('end_date', array('class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly' )); ?> </td>
        </tr>
        <tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>               
      	</table>
      	
      	<label>INFORMACI&Oacute;N ADICIONAL:</label>       
            	<?php echo $this->Form->input('observations', array ('label' => ' ')); ?>  
            	
          <?php echo $this->Form->end('Ingresar Contrato'); ?>     
    </fieldset>       
    
</div>

 <script language="javascript" type="text/javascript">
		
             $(document).ready(function() {
             	var apartments;             	
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
                
                $('#LeaseLocationId').change(function(){                    
                    var selectedLoc = $(this).val();   
                    $.ajax({ 
                        type: 'POST',  
                        dataType: 'json',
                        contentType : 'application/json; charset=utf-8',                      
                        url: '/LocalRenter/Apartments/fetchAvailableApartments/' + selectedLoc,   
                        success: function (data){
                        	apartments = data;
                            $('#LeaseApartmentId').empty();   
                                                                          
                            $.each(data,function(i,apartment){
                                $('#LeaseApartmentId').append("<option value='" + apartment['Apartment']['id'] + 
                                        "'>" + apartment['Apartment']['name'] + "</option>")});                               
                                        
                            $("#LeaseApartmentId").trigger("change");                            
                        },
                        error: function(e){                            
                            console.log(e);
                        }
                   });
                
            });
            $('#LeaseApartmentId').change(function(){             
            	$.each(apartments,function(i,apartment){            		
                       if (apartment['Apartment']['id'] == $('#LeaseApartmentId').val()) {                       		
                       		$('#LeaseAmount').val(apartment['Apartment']['rent_price']);
                       		return false;
                       }                          
                  });
            });
            
            $("#LeaseLocationId").trigger("change");            
            });
           
</script>