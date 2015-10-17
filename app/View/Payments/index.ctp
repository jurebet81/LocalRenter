<div class="formFilter">     
    <fieldset>
        <legend>Filtros Consulta de Pagos</legend>  
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
                       $('#PaymentToDate').val('');
                       $('#PaymentFromDate').val('');                      
                    }
                });
                
                $('#FbyLocation').change(function(){
                    
                    if ($('#FbyLocation').prop('checked')){
                        $('#PaymentLocationId').show();                       
                    }else{
                         $('#PaymentLocationId').hide();
                         $('#PaymentLocationId').val('-1');
                         $('#FbyApartment').prop('checked', false);
                         $('#PaymentApartmentId').hide();
                         $('#PaymentApartmentId').val('-1');
                    }
                });

                $('#FbyApartment').change(function(){                    
                    if ($('#FbyApartment').prop('checked')){
                    	$('#FbyLocation').prop('checked', true);
                    	$('#PaymentLocationId').show();  
                        $('#PaymentApartmentId').show();                       
                    }else{
                         $('#PaymentApartmentId').hide();
                         $('#PaymentApartmentId').val('-1');
                    }
                });

                $('#PaymentLocationId').change(function(){                    
                    var selectedLoc = $(this).val();   
                    $.ajax({ 
                        type: 'POST',  
                        dataType: 'json',
                        contentType : 'application/json; charset=utf-8',                      
                        url: '/LocalRenter/Apartments/fetchAllApartments/' + selectedLoc,   
                        success: function (data){    
                            
                            $('#PaymentApartmentId').empty();                                                                             
                            $.each(data,function(i,apartment){
                                $('#PaymentApartmentId').append("<option value='" + apartment['Apartment']['id'] + 
                                        "'>" + apartment['Apartment']['name'] + "</option>")});                               
                                                   
                        },
                        error: function(e){                            
                            console.log(e);
                        }
                   });
                
            	});                
                
                $('.submit').click(function(){
                    
                    if ($('#FbyLocation').prop('checked')){     //valida que se ingresó un proveedor
                        if ( $('#PaymentLocationId').val()=== '-1'){
                            alert('Debe seleccionar una ubicacion');
                            return false;
                        }
                    }else{$('#PaymentLocationId').val('-1');}

                    if ($('#FbyApartment').prop('checked')){     //valida que se ingresó un proveedor
                        if ( $('#PaymentApartmentId').val()=== '-1'){
                            alert('Debe seleccionar un apartament');
                            return false;
                        }
                    }else{
                    	$('#PaymentApartmentId').empty();  //machete para 
                    	$('#PaymentApartmentId').append("<option value='-1'>-1</option>");
                	$('#PaymentApartmentId').val('-1');
                    }
                    
                    if ($('#FbyDate').prop('checked')){
                        
                        if ( $('#PaymentToDate').val()==='' || $('#PaymentFromDate').val()===''){
                            alert('Debe ingresar fechas correctas');
                            return false;
                        }
                        
                        if ($('#PaymentToDate').val()<$('#PaymentFromDate').val()){
                            alert('La fecha final debe ser mayor que la fecha incial');
                            return false;
                        }
                    }
                    
                });
            });
</script>