<div class="view">
    
    <h3>LISTA DE VENTAS</h3>
    <table class ="tablesummary">
        <tr>
            <th> <?php echo $this->Paginator->sort('id', 'FACTURA NRO')?></th>
            <th> <?php echo $this->Paginator->sort('Client.name', 'CLIENTE')?></th>
            <th> <?php echo $this->Paginator->sort('date', 'FECHA VENTA')?></th>
            <th>VALOR TOTAL</th>            
            <th>ACCIONES</th>
            
        </tr>
        <?php $totalSales = 0; ?>
        <?php foreach ($sales as $sale){ ?>
        <tr>
            <td> <?php echo h($sale['Sale']['id']); ?></td>
            <td> <?php echo h($sale['Cl']['name']); ?></td>
            <td> <?php echo h($sale['Sale']['date']); ?></td> 
            <td id="pesosValue"> <?php echo number_format(h($sale['0']['total']), 0, '.', '.'); ?></td>
            
            <td>
                <?php echo $this->Html->image('details-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Saledetails', 'action' => 'view', $sale['Sale']['id'])
                         ));
                ?>           
                <?php echo $this->Html->image('printer-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Saledetails', 'action' => 'printReceipt', $sale['Sale']['id'])
                         ));
                ?>          
                <?php echo $this->Html->image('edit-icon.png', array ("alt" =>"CakePHP", 'url' =>
                    array ('controller' => 'Saledetails', 'action' => 'add', $sale['Sale']['id']),
                    
                         ));
                 ?>
            </td>
        </tr>
        <?php 
            $totalSales = $totalSales + h($sale['0']['total']);
        } ?>
        <tr> 
            <td></td><td></td>
            <td id ='totalvalue'> 
                Total
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalSales, 0, '.', '.'); ?> </div>
            </td>
            <td></td>        
        </tr>
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