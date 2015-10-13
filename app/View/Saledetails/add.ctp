
<table class="tablesummary">
    <tr>        
        <th>Factura Nro</th>
        <th>Cliente</th>
        <th>Fecha de venta</th>
        <th id ='totalheader'>Total</th>
        <th>Imprimir Factura</th>
    </tr>
    <tr>
        <td><?php echo $sal['Sale']['id']; ?></td>        
        <td><?php echo $sal['Client']['name']; ?></td>
        <td><?php echo $sal['Sale']['date']; ?></td>
        <td id ='totalvalue'> 
            <?php
                $totalSale = 0;        
                foreach ($saledetails as  $detail) { $totalSale = $totalSale + $detail['Saledetail']['total_price']; }                
                echo number_format($totalSale, 0, '.', '.')
            ?>
        </td>
        <td><?php echo $this->Html->image('printer-icon.png', array ('alt' =>'CakePHP', 
            'url' => array ('action' => 'printReceipt', $sal['Sale']['id'])));
            ?>
        </td>                
    <tr>    
</table>
<br>

<div class="addpro">
    <fieldset> 
        <legend>Producto</legend>
        <?php echo $this->Form->create('Saledetail'); ?>            
        <label>Producto:</label>
            <?php echo $this->Form->input('product_id', array ('label' => ''));?>     
        <label>Cantidad:</label>
            <?php echo $this->Form->input('amount', array ('label' => '', 'type'=>'text')); ?>       
        <label>Valor Unitario:</label>
            <?php echo $this->Form->input('unit_price', array('label' => '', 'type'=>'text','readonly' => 'readonly'))?>
        <label>Valor Total:</label>
            <?php echo $this->Form->input('total_price', array('label' => '', 'type'=>'text','readonly' => 'readonly'))?>      
        <?php echo $this->Form->hidden('sale_id', array ('value' => $sal['Sale']['id']));?>
    </fieldset>
    <?php echo $this->Form->end('Agregar Producto'); ?>    
</div>
    <div id='rightContainer'>
        <table class="tablesummary">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Valor Uni</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Eliminar</th>

            </tr> 
            <?php        
            foreach ($saledetails as  $detail){ ?>        
            <tr>           
                <td> <?php  echo $detail['Saledetail']['id']; ?></td>
                <td> <?php  echo $detail['Product']['name']; ?></td>
                <td> <?php  echo $detail['Saledetail']['unit_price']; ?></td>
                <td> <?php  echo $detail['Saledetail']['amount']; ?></td>
                <td> <?php  echo number_format($detail['Saledetail']['total_price'], 0, '.', '.') ; ?></td>  
                <td><?php echo $this->Html->image('delete-icon.png', array ('alt' =>'CakePHP', 'url' =>
                        array ('action' => 'delete', $detail['Saledetail']['id'], $sal['Sale']['id'])
                             ));
                     ?>
                </td>
            </tr>
        <?php }?>
        </table>         
    </div>

<script type="text/javascript">
	        
	$(document).ready(function(){            
            
            $("#SaledetailProductId").change(function(){
                var id = $("#SaledetailProductId").val();             
                $.ajax({				// Request method: post, get
                    url: "../../products/getData/"+id,// URL to request				
                    dataType: 'json',	// Expected response type
                    success: function(data) {
                            $('#SaledetailUnitPrice').val(data.Product.unit_price);  
                            $( "#SaledetailAmount" ).trigger( "keyup" );
                    },
                    error: function() {
                            alert('Error, contacte al administrador');
                    }
                });
            return false;            
            });
            
            $("#SaledetailAmount").keyup(function(){                
                                    
                    var amount = $('#SaledetailAmount').val();
                    var uPrice = $('#SaledetailUnitPrice').val();
                    var total = amount*uPrice;                    
                    if (isNaN(total)){
                        total = 0;
                    }
                    $('#SaledetailTotalPrice').val(total);
                               
            });
            
            $( "#SaledetailProductId" ).trigger( "change" );
        });
</script>