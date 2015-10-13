<div class="add">    
     
    <?php echo $this->Form->create('Purchase') ?>
    <fieldset>
        <legend> Nuevo Lote </legend>        
        <label>Proveedor:</label>
            <?php echo $this->Form->input('provider_id', array ('label' => ''));?> <br>
        
        <label>Factura Nro:</label>
            <?php echo $this->Form->input('id_invoice', array ('label' => '')); ?> <br>
        
        <!--<label>Fecha de Pedido:</label>-->
            <?php //echo $this->Form->input('date_requested', array(
                //'class'=>'datepicker', 'type'=>'text','label'=>'' , 'readonly' => 'readonly')); ?>
        <label>Fecha: </label>
            <?php echo $this->Form->input('date_delivered', array(
                'class'=>'datepicker', 'type'=>'text','label'=>'','readonly' => 'readonly' )); ?> <br>        
        
        <label>Informaci&oacuten Adicional:</label><?php echo $this->Form->input('observations', array ('label' => '')); ?>
    </fieldset>
    <?php echo $this->Form->end('Acentar Factura'); ?>
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
                })  
        });
</script>