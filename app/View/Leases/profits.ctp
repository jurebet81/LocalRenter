<div class="formFilter">     
    <fieldset>
        <legend>Filtros Consulta de Utilidades</legend>  
            <?php echo $this->Form->create(array('action' => 'profit'));?>
                <label>A&Ntilde;O : </label>                
                <?php echo $this->Form->input('year', array ('label' => ''));?> <br> <br>              
            <label>MES : </label>
                <?php echo $this->Form->input('month', array ('label' => ''));?> <br> <br>  
            <label>UBICACI&Oacute;N : </label>
                <?php echo $this->Form->input('location_id', array ('label' => ''));?> <br> <br>
                
            <label>APARTAMENTO: </label>
                <?php echo $this->Form->input('apartment_id', array ('label' => ''));?>
                        
            <?php echo $this->Form->End(' Consultar '); ?> 
    </fieldset>   
</div>

<script language="javascript" type="text/javascript">	
            
            $(document).ready(function(){
                
                $('.submit').click(function(){                    
                    if ( $('#SaleYear').val()=== '-1'){
                        alert('Debe seleccionar el año para la consulta');
                        return false;
                    }
                              
                }); 

                $('#LeaseLocationId').change(function(){                    
                    var selectedLoc = $(this).val();   
                    $.ajax({ 
                        type: 'POST',  
                        dataType: 'json',
                        contentType : 'application/json; charset=utf-8',                      
                        url: '/LocalRenter/Apartments/fetchAllApartments/' + selectedLoc,
                           
                        success: function (data){   
                            
                            $('#LeaseApartmentId').empty();                                                                             
                            $.each(data,function(i,apartment){
                                $('#LeaseApartmentId').append("<option value='" + apartment['Apartment']['id'] + 
                                        "'>" + apartment['Apartment']['name'] + "</option>");});                               
                                        
                            //$("#ExpenseApartmentId").trigger("change");                            
                        },
                        error: function(e){                            
                            console.log(e);
                        }
                   });
                
            	});                 
                
            });
</script>