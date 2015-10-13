<div class="view">
    
    <h3>LISTA DE LOTES</h3>
    <table class ="tablesummary">
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'ID')?></th>
            <th><?php echo $this->Paginator->sort('Provider.name', 'PROVEEDOR')?></th>
            <th><?php echo $this->Paginator->sort('id_invoice', 'FACTURA NRO')?></th>
            <?php //echo $this->Paginator->sort('date_requested', 'FECHA DE PEDIDO')?>
            <th><?php echo $this->Paginator->sort('date_delivered', 'FECHA DE ENTREGA')?></th>
            <th>VALOR TOTAL</th>            
            <th>ACCIONES</th>            
        </tr>
        <?php $totalPurchases = 0; ?>
        <?php //$dataQuery = array_pop($purchases); ?>
        <?php //echo($dataQuery['fDate']); ?>
        <?php foreach ($purchases as $purchase){ ?>
        <tr>
            <td><?php echo h($purchase['Purchase']['id']); ?></td>
            <td><?php echo h($purchase['Pr']['name']); ?></td>   
            <td><?php echo h($purchase['Purchase']['id_invoice']); ?></td>
            <?php //echo h($purchase['Purchase']['date_requested']); ?>
            <td><?php echo h($purchase['Purchase']['date_delivered']); ?></td>
            <td id="pesosValue"><?php echo number_format(h($purchase['0']['total']), 0, '.', '.'); ?></td>            
            <td><?php echo $this->Html->image('details-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Purchasedetails', 'action' => 'view', $purchase['Purchase']['id'])
                    
                         ));
                ?>            
                <?php echo $this->Html->image('edit-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Purchasedetails', 'action' => 'add', $purchase['Purchase']['id'])
                         ));
                 ?>
            </td>
        </tr>
        <?php 
            $totalPurchases = $totalPurchases + h($purchase['0']['total']);
        } ?>
        <tr> 
            <td></td><td></td><td></td>
            <td id ='totalvalue'> 
                Total
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalPurchases, 0, '.', '.'); ?> </div>
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

 