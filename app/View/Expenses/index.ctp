<div class="formFilter">     
    <fieldset>
        <legend>Filtros Consulta Gastos</legend>  
            <?php echo $this->Form->create(array('action' => 'view'));?>
                
                <input type='checkbox' id='FbyLocation'> POR UBICACI&Oacute;N:
                    <?php echo $this->Form->input('location_id', array ('label' => '','hidden'));?><br><br>
                    
                <input type='checkbox' id='FbyApartment'> POR APARTAMENTO:
                    <?php echo $this->Form->input('apartment_id', array ('label' => '','hidden'));?><br><br>
                    
                <input type="checkbox" id="FbyDate"> POR FECHA:            
                <div id ="dateContainer">
                   <label>Desde:</label> <?php echo $this->Form->input('FromDate', array(
                        'class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly','default'=>'')); ?> 
                    
                   <label>Hasta:</label> <?php echo $this->Form->input('ToDate', array(
                        'class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly', 'default'=>'')); ?>      
                </div>   
                
                <?php echo $this->Form->End(' Consultar '); ?>             
    </fieldset>
    
</div>


<script language="javascript" type="text/javascript">	
            
            $(document).ready(function(){                
                $('#dateContainer').hide();                
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
                            
                $('#FbyDate').change(function(){
                    if ($('#FbyDate').prop('checked')){                        
                        $('#dateContainer').show();
                    }else{
                       $('#dateContainer').hide();
                       $('#PurchaseToDate').val('');
                       $('#PurchaseFromDate').val('');                      
                    }
                });
                
                $('#FbyLocation').change(function(){
                    
                    if ($('#FbyLocation').prop('checked')){
                        $('#ExpenseLocationId').show();                       
                    }else{
                         $('#ExpenseLocationId').hide();
                         $('#ExpenseLocationId').val('-1');
                         $('#FbyApartment').prop('checked', false);
                         $('#ExpenseApartmentId').hide();
                         $('#ExpenseApartmentId').val('-1');
                    }
                });

				$('#FbyApartment').change(function(){                    
                    if ($('#FbyApartment').prop('checked')){
                    	$('#FbyLocation').prop('checked', true);
                    	$('#ExpenseLocationId').show();  
                        $('#ExpenseApartmentId').show();                       
                    }else{
                         $('#ExpenseApartmentId').hide();
                         $('#ExpenseApartmentId').val('-1');
                    }
                });

				$('#ExpenseLocationId').change(function(){                    
                    var selectedLoc = $(this).val();   
                    $.ajax({ 
                        type: 'POST',  
                        dataType: 'json',
                        contentType : 'application/json; charset=utf-8',                      
                        url: '/LocalRenter/Expenses/fetchApartments/' + selectedLoc,   
                        success: function (data){    
                            
                            $('#ExpenseApartmentId').empty();                                                                             
                            $.each(data,function(i,apartment){
                                $('#ExpenseApartmentId').append("<option value='" + apartment['Apartment']['id'] + 
                                        "'>" + apartment['Apartment']['name'] + "</option>")});                               
                                                   
                        },
                        error: function(e){                            
                            console.log(e);
                        }
                   });
                
            	});                
                
                $('.submit').click(function(){
                    
                    if ($('#FbyLocation').prop('checked')){     //valida que se ingresó un proveedor
                        if ( $('#ExpenseLocationId').val()=== '-1'){
                            alert('Debe seleccionar una ubicacion');
                            return false;
                        }
                    }else{$('#ExpenseLocationId').val('-1');}

                    if ($('#FbyApartment').prop('checked')){     //valida que se ingresó un proveedor
                        if ( $('#ExpenseApartmentId').val()=== '-1'){
                            alert('Debe seleccionar un apartament');
                            return false;
                        }
                    }else{
                    	$('#ExpenseApartmentId').empty();  //machete para 
                    	$('#ExpenseApartmentId').append("<option value='-1'>-1</option>");
                		$('#ExpenseApartmentId').val('-1');
                    }
                    
                    if ($('#FbyDate').prop('checked')){
                        
                        if ( $('#ExpenseToDate').val()==='' || $('#ExpenseFromDate').val()===''){
                            alert('Debe ingresar fechas correctas');
                            return false;
                        }
                        
                        if ($('#ExpenseToDate').val()<$('#ExpenseFromDate').val()){
                            alert('La fecha final debe ser mayor que la fecha incial');
                            return false;
                        }
                    }
                    
                });
            });
</script>