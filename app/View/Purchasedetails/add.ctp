<table class="tablesummary">
    <tr>
        <th>Id</th>
        <th>Factura Nro</th>
        <th>Proveedor</th>       
        <!--<th>Fecha Pedido</th>-->
        <th>Fecha</th>
        <th id ='totalheader'>Valor Total</th>
    </tr>
    <tr>
        <td><?php echo $purch['Purchase']['id']; ?></td>
        <td><?php echo $purch['Purchase']['id_invoice']; ?></td>
        <td><?php echo $purch['Provider']['name']; ?></td>        
        <?php //echo $purch['Purchase']['date_requested']; ?>
        <td><?php echo $purch['Purchase']['date_delivered']; ?></td> 
        <td id ='totalvalue'> 
            <?php
                $totalPurch = 0;        
                foreach ($purchasedetails as  $detail) 
                    { $totalPurch = $totalPurch + $detail['Purchasedetail']['total_price']; }
                echo number_format($totalPurch, 0, '.', '.');
            ?>
        </td>
    <tr>    
</table>
<br>

<div class="addpro">
    <fieldset> 
        <legend>Productos</legend>
        <?php echo $this->Form->create('Purchasedetail'); ?>            
        <label>Producto:</label>
            <?php echo $this->Form->input('product_id', array ('label' => ''));?>        
        <label>Cantidad:</label>
            <?php echo $this->Form->input('amount', array ('label' => '', 'type'=>'text')); ?>        
        <label>Valor Unitario:</label>
            <?php echo $this->Form->input('unit_price', array('label' => '', 'type'=>'text'))?>
        <label>Valor Total:</label>
            <?php echo $this->Form->input('total_price', array('label' => '', 'type'=>'text','readonly' => 'readonly'))?>       
        <?php echo $this->Form->hidden('purchase_id', array ('value' => $purch['Purchase']['id']));?>
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
                $totalLote = 0;
                foreach ($purchasedetails as  $detail){ ?>  

                <tr>           
                    <td> <?php  echo $detail['Purchasedetail']['id']; ?></td>
                    <td> <?php  echo $detail['Product']['name']; ?></td>
                    <td> <?php  echo $detail['Purchasedetail']['unit_price']; ?></td>
                    <td> <?php  echo $detail['Purchasedetail']['amount']; ?></td>
                    <td> <?php  echo number_format($detail['Purchasedetail']['total_price'], 0, '.', '.'); ?></td>            
                    <td><?php echo $this->Html->image('delete-icon.png', array ('alt' =>'CakePHP', 'url' =>
                            array ('action' => 'delete', $detail['Purchasedetail']['id'], $purch['Purchase']['id'])
                                 ));
                         ?>
                    </td>
            </tr>
         <?php 
                $totalLote = $totalLote + $detail['Purchasedetail']['total_price'];
         } ?>
     </table>    
 </div>
       

 <script language="javascript" type="text/javascript">		
           $(document).ready(function() {                
            $('#PurchasedetailAmount, #PurchasedetailUnitPrice').keyup(function(){                
                                  
                    var amount = $('#PurchasedetailAmount').val();
                    var uPrice = $('#PurchasedetailUnitPrice').val();
                    var total = amount*uPrice;                    
                    if (isNaN(total)){
                        total = 0;
                    }
                    $('#PurchasedetailTotalPrice').val(total);                               
            });
        });
</script>