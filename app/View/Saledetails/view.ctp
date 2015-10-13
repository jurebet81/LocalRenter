<h3>DETALLE DE VENTA</h3>
<table class ="tablesummary">
    <tr>        
        <th>FACTURA NRO</th>
        <th>CLIENTE</th>
        <th>FECHA DE VENTA</th> 
        <th id ='totalheader'>TOTAL VENTA</th>
        <th>OBSERVACIONES</th> 
         
    </tr>
    <tr>
        <td><?php echo $sal['Sale']['id']; ?></td>        
        <td><?php echo $sal['Client']['name']; ?></td>
        <td><?php echo $sal['Sale']['date']; ?></td>
        <td id ='totalvalue'> <?php echo number_format($sal['Sale']['total'], 0, '.', '.'); ?> </td>
        <td><?php echo $sal['Sale']['observations']; ?></td>
        
    <tr>    
</table>
<br>
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
        
        foreach ($saledetails as  $detail){ ?>        
        <tr>           
            <td> <?php  echo $detail['Saledetail']['id']; ?></td>
            <td> <?php  echo $detail['Product']['name']; ?></td>
            <td> <?php  echo $detail['Saledetail']['unit_price']; ?></td>
            <td> <?php  echo $detail['Saledetail']['amount']; ?></td>
            <td> <?php  echo number_format($detail['Saledetail']['total_price']); ?></td>  
            
        </tr>
    <?php     
        }?>
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