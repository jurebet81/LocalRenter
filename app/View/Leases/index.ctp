<div class="formFilter">     
    <fieldset>
        <legend>Filtros Consulta de Ventas</legend>  
            <?php echo $this->Form->create(array('action' => 'view'));?>
                
                <input type='checkbox' id='FbyClient'> Buscar por Cliente
                    <?php echo $this->Form->input('client_id', array ('label' => '','hidden'));?><br><br>
                    
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
                    dateFormat: 'yy-mm-dd',
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
                       $('#SaleToDate').val('');
                       $('#SaleFromDate').val('');                      
                    }
                });
                
                $('#FbyClient').change(function(){
                    
                    if ($('#FbyClient').prop('checked')){
                        $('#SaleClientId').show();                       
                    }else{
                         $('#SaleClientId').hide();
                         $('#SaleClientId').val('-1');
                    }
                });
                
                $('.submit').click(function(){
                    
                    if ($('#FbyClient').prop('checked')){     //valida que se ingresó un cliente
                        if ( $('#SaleClientId').val()=== '-1'){
                            alert('Debe seleccionar un cliente');
                            return false;
                        }
                    }
                    
                    if ($('#FbyDate').prop('checked')){
                        
                        if ( $('#SaleToDate').val()==='' || $('#SaleFromDate').val()===''){
                            alert('Debe ingresar fechas correctas');
                            return false;
                        }
                        if ($('#SaleToDate').val()<$('#SaleFromDate').val()){
                            alert('La fecha final debe ser mayor o igual que la fecha incial');
                            return false;
                        }
                    }
                    
                });
            });
</script>