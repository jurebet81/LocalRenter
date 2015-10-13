<div class="formFilter">     
    <fieldset>
        <legend>Filtros Consulta de Lotes</legend>  
            <?php echo $this->Form->create(array('action' => 'view'));?>
                
                <input type='checkbox' id='FbyProvider'> Buscar por Proveedor
                    <?php echo $this->Form->input('provider_id', array ('label' => '','hidden'));?><br><br>
                    
                <input type="checkbox" id="FbyDate"> Buscar por Fecha                
                <div id ="dateContainer">
                   <label>Desde:</label> <?php echo $this->Form->input('FromDate', array(
                        'class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly','default'=>'')); ?> 
                    
                   <label>Hasta:</label> <?php echo $this->Form->input('ToDate', array(
                        'class'=>'datepicker', 'type'=>'text','label'=>'', 'readonly' => 'readonly', 'default'=>'')); ?>      
                </div               
    </fieldset>
    <?php echo $this->Form->End(' Consultar '); ?> 
</div>


<script language="javascript" type="text/javascript">	
            
            $(document).ready(function(){
                
                $('#dateContainer').hide();
                
                $( "input.datepicker" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                    yearRange: "-100:+50",
                    changeMonth: true,
                    changeYear: true,
                    constrainInput: false,
                    showOn: 'both',
                    buttonImage: "/StockApp/img/calendar.png",
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
                
                $('#FbyProvider').change(function(){
                    
                    if ($('#FbyProvider').prop('checked')){
                        $('#PurchaseProviderId').show();                       
                    }else{
                         $('#PurchaseProviderId').hide();
                         $('#PurchaseProviderId').val('-1');
                    }
                });
                
                $('.submit').click(function(){
                    
                    if ($('#FbyProvider').prop('checked')){     //valida que se ingresó un proveedor
                        if ( $('#PurchaseProviderId').val()=== '-1'){
                            alert('Debe seleccionar un proveedor');
                            return false;
                        }
                    }
                    
                    if ($('#FbyDate').prop('checked')){
                        
                        if ( $('#PurchaseToDate').val()==='' || $('#PurchaseFromDate').val()===''){
                            alert('Debe ingresar fechas correctas');
                            return false;
                        }
                        if ($('#PurchaseToDate').val()<$('#PurchaseFromDate').val()){
                            alert('La fecha final debe ser mayor que la fecha incial');
                            return false;
                        }
                    }
                    
                });
            });
</script>