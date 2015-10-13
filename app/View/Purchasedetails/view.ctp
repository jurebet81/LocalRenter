<h3>DETALLE DE LOTE</h3>
<table class ="tablesummary">
    <tr>        
        <th>FACTURA NRO</th>
        <th>PROVEEDOR</th>
        <th>FECHA PEDIDO</th>
        <th>FECHA LLEGADA</th>
        <th id ='totalheader'>TOTAL</th> 
        <th>OBSERVACIONES</th> 
        
    </tr>
    <tr>
        <td><?php echo $purch['Purchase']['id_invoice']; ?></td>
        <td><?php echo $purch['Provider']['name']; ?></td>   
        <td><?php //echo $purch['Purchase']['date_requested']; ?></td>
        <td><?php echo $purch['Purchase']['date_delivered']; ?></td>
        <td id ='totalvalue'> 
            <?php echo number_format($purch['Purchase']['total'], 0, '.', '.');  ?>
        </td>
        <td> <?php echo $purch['Purchase']['observations']; ?></td>  
        
    </tr>    
</table>
<h2>Productos</h2>
<div class="view">      
    <table class ="tablesummary">    
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'ID')?></th>
            <th><?php echo $this->Paginator->sort('Product.name', 'NOMBRE')?></th>
            <th>VALOR UNITARIO</th>
            <th>CANTIDAD</th>
            <th>TOTAL</th>            
        </tr>
        
        <?php        
        foreach ($purchasedetails as  $detail){ ?>        
        <tr>           
            <td> <?php  echo $detail['Purchasedetail']['id']; ?></td>
            <td> <?php  echo $detail['Product']['name']; ?></td>
            <td> <?php  echo $detail['Purchasedetail']['unit_price']; ?></td>
            <td> <?php  echo $detail['Purchasedetail']['amount']; ?></td>
            <td> <?php  echo $detail['Purchasedetail']['total_price']; ?></td>            
        </tr>
    <?php }?>
</table>    
        
    <p class ="infoPag"> 
        <?php echo $this->Paginator->counter(
                array('format' => 'Página {:page} de {:pages}, mostrando {:current} registros de {:count}') //paginacion                
            );
        ?>
    </p>
    
     <div class='pagination'>
        
        <?php echo $this->Paginator->prev('Anterior', array(), null, array('class' => 'disabled'));?>
        <?php echo $this->Paginator->numbers(array('separator' => '')); ?>
        <?php echo $this->Paginator->next('Siguiente', array(), null, array ('class' => 'disabled'));?>
        
    </div>       
</div>