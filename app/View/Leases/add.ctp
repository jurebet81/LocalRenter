<div class="add">    
     
    <?php echo $this->Form->create('Lease') ?>
    <fieldset>
        <legend> Rentar </legend> 
        <label>Locacion:</label>
            <?php echo $this->Form->input('location_id',  array ('label' => ''));?><br>
        <label>Apartamento:</label>
            <?php echo $this->Form->input('apartament_id',  array ('label' => ''));?><br>        
        <label>Fecha de Renta:</label>
            <?php echo $this->Form->input('date', array('class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly' )); ?>  <br>
        <label>Informaci&oacuten Adicional:</label>
            <?php echo $this->Form->input('observations', array ('label' => ' ')); ?>        
    </fieldset>
    <?php echo $this->Form->end('Rentar'); ?>
</div>

 <script language="javascript" type="text/javascript">
		
             $(document).ready(function() {
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
                            $('#LeaseApartamentId').empty();                            
                            $.each(data,function(i,value){
                                $('#LeaseApartamentId').append("<option value='" + i + 
                                        "'>" + value + "</option>")});                            
                        },
                        error: function(e){                            
                            console.log(e);
                        }
                    });
                
            });
            
            });
           
        </script>