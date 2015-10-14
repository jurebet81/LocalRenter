<div class="view">
    
    <h3>LISTA DE CONTRATOS ACTIVOS</h3>
    <table class ="tablesummary">
        <tr>
            <th> <?php echo $this->Paginator->sort('id', 'CONTRATO No.')?></th>
            <th> <?php echo $this->Paginator->sort('holder_name', 'INQUILINO')?></th>
            <th> <?php echo $this->Paginator->sort('Apto.name', 'APARTAMENTO')?></th>            
            <th>VALOR CONTRATO</th> 
            <th> <?php echo $this->Paginator->sort('last_payment_date', 'PAGO_HASTA')?></th>                       
            <th>OPERACIONES</th>
            
        </tr>
        
        <?php foreach ($leases as $lease){ ?>
        <tr>
            <td> <?php echo h($lease['Lease']['id']); ?></td>
            <td> <?php echo h($lease['Lease']['holder_name']); ?></td>
            <td> <?php echo h($lease['Apto']['name']); ?></td>             
            <td> <?php echo number_format(h($lease['Lease']['amount']), 0, '.', '.'); ?></td> 
            <td> <?php echo h($lease['Lease']['last_payment_date']); ?></td>                         
            <td>
                 <?php echo $this->Html->image('payment-icon.png', array ("alt" =>"CakePHP", 'url' =>
                    array ('controller' => 'Payments', 'action' => 'add', $lease['Lease']['id']),                    
                         ));
                 ?> 
                <?php echo $this->Html->image('edit-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Lease', 'action' => 'edit', $lease['Lease']['id'])
                         ));
                ?>          
                <?php echo $this->Html->image('printer-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Lease', 'action' => 'download', $lease['Lease']['id'])
                         ));
                ?>                                          
                 <?php echo $this->Html->image('delete-icon.png', array ("alt" =>"CakePHP", 'url' =>
                    array ('controller' => 'Lease', 'action' => 'close', $lease['Lease']['id']),                    
                         ));
                 ?>
                 
            </td>
        </tr>
        <?php } ?>
        
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