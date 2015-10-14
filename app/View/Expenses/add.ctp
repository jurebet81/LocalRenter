<div class="add">    
     
    <?php echo $this->Form->create('Expense') ?>
    <fieldset>
        <legend> Ingresar Gastos </legend>        
        <label>Ubicaci&oacute;n: </label>
            <?php echo $this->Form->input('location_id', array ('label' => ''));?> <br>        
        <label>Apartamento:</label>
            <?php echo $this->Form->input('apartament_id', array ('label' => '')); ?> <br>  
        <label>Valor : </label>
            <?php echo $this->Form->input('amount', array ('label' => ''));?> <br>           
        <label>Fecha: </label>
            <?php echo $this->Form->input('date', array(
                'class'=>'datepicker', 'type'=>'text','label'=>'','readonly' => 'readonly' )); ?> <br> 
        <label>Descripci&oacute;n del Gasto:</label>
        <?php echo $this->Form->input('description', array ('label' => '')); ?>
    </fieldset>
    <?php echo $this->Form->end('Acentar Gasto'); ?>
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
                    buttonImage: "/StockApp/img/calendar.png",
                    buttonImageOnly: true                                        
                });

                $('#ExpenseLocationId').change(function(){                    
                    var selectedLoc = $(this).val();   
                    $.ajax({ 
                        type: 'POST',  
                        dataType: 'json',
                        contentType : 'application/json; charset=utf-8',                      
                        url: '/LocalRenter/Expenses/fetchApartaments/' + selectedLoc,   
                        success: function (data){    
                            
                            $('#ExpenseApartamentId').empty();                                                                             
                            $.each(data,function(i,apartament){
                                $('#ExpenseApartamentId').append("<option value='" + apartament['Apartament']['id'] + 
                                        "'>" + apartament['Apartament']['name'] + "</option>")});                               
                                        
                            //$("#ExpenseApartamentId").trigger("change");                            
                        },
                        error: function(e){                            
                            console.log(e);
                        }
                   });
                
            });  
        });
</script>