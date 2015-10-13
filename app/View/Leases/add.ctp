<div class="add">    
     
    <?php echo $this->Form->create('Lease') ?>
    <fieldset>
        <legend> Contrato de Arrendamiento </legend> 
         <label>Nombre del Inquilino:</label>
            <?php echo $this->Form->input('holder_name',  array ('label' => ''));?><br>
        <label>C&eacute;dula del Inquilino: </label>
            <?php echo $this->Form->input('holder_identification',  array ('label' => ''));?><br> 
        <label>Ubicaci&oacute;n:</label>
            <?php echo $this->Form->input('location_id',  array ('label' => ''));?><br>
        <label>Apartamento a tomar:</label>
            <?php echo $this->Form->input('apartament_id',  array ('label' => ''));?><br>  
        <label>Valor Arriendo acordado:</label>
            <?php echo $this->Form->input('amount',  array ('label' => ''));?><br>  
        <label>Arrendatario:</label>
            <?php echo $this->Form->input('renter_id',  array ('label' => ''));?><br>      
        <label>Fecha de inicio de Arriendo:</label>
            <?php echo $this->Form->input('init_date', array('class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly' )); ?>  <br>
        <label>Fecha de fin de Arriendo:</label>
            <?php echo $this->Form->input('end_date', array('class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly' )); ?>  <br>
           
             <?php /*echo $this->Form->input('Frecuency', array('type' => 'radio', 'options' => array('Mensual' => 'Mensual','Semanal' => 'Semanal'),
    				'class' => 'testClass',
    				'selected' => 'Mensual',
    				'before' => '<div class="testOuterClass">',
    				'after' => '</div>',
    				'hiddenField' => false,)); // added for non-first elements	*/	?>				
		
        <label>Informaci&oacuten Adicional:</label>       
            <?php echo $this->Form->input('observations', array ('label' => ' ')); ?>        
    </fieldset>
         
        
    <?php echo $this->Form->end('Arrendar'); ?>
</div>

 <script language="javascript" type="text/javascript">
		
             $(document).ready(function() {
             	var apartaments;             	
                $( "input.datepicker" ).datepicker({
                    dateFormat: 'dd-mm-yy',
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
                        url: '/LocalRenter/Leases/fetchApartaments/' + selectedLoc,   
                        success: function (data){
                        	apartaments = data;
                            $('#LeaseApartamentId').empty();   
                                                                          
                            $.each(data,function(i,apartament){
                                $('#LeaseApartamentId').append("<option value='" + apartament['Apartament']['id'] + 
                                        "'>" + apartament['Apartament']['name'] + "</option>")});                               
                                        
                            $("#LeaseApartamentId").trigger("change");                            
                        },
                        error: function(e){                            
                            console.log(e);
                        }
                   });
                
            });
            $('#LeaseApartamentId').change(function(){             
            	$.each(apartaments,function(i,apartament){            		
                       if (apartament['Apartament']['id'] == $('#LeaseApartamentId').val()) {                       		
                       		$('#LeaseAmount').val(apartament['Apartament']['rent_price']);
                       		return false;
                       }                          
                  });
            });
            
            $("#LeaseLocationId").trigger("change");            
            });
           
        </script>