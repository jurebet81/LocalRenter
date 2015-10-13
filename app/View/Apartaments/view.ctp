<div class="view">
    
    <h3>INVENTARIO DE PRODUCTOS</h3>
    <table class ="tablesummary">
        <tr>
            <th><?php echo $this->Paginator->sort('id','ID'); ?></th>
            <th><?php echo $this->Paginator->sort('name','NOMBRE'); ?></th>
            <th><?php echo $this->Paginator->sort('amount','CANTIDAD'); ?></th>
            <th><?php echo $this->Paginator->sort('unit_price','PRECIOUNI.'); ?></th>
            <th><?php echo $this->Paginator->sort('date_submitted','FECHAINGR'); ?></th>
            <th>OBSERVACIONES</th>
            <th>EDITAR</th>            
        </tr>
        <?php foreach ($products as $product){ ?>
        <tr>
            <td><?php echo h($product['Product']['id']); ?></td>
            <td><?php echo h($product['Product']['name']); ?></td>
            <td><?php echo h($product['Product']['amount']); ?></td>
            <td><?php echo h($product['Product']['unit_price']); ?></td>
            <td><?php echo h($product['Product']['date_submitted']); ?></td>
            <td><?php echo h($product['Product']['observations']); ?></td>
            <td><?php echo $this->Html->image('edit-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('action' => 'edit', $product['Product']['id'])
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