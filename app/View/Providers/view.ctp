<div class="view">
    
    <h3>LISTA DE PROVEEDORES</h3>
    <table class ="tablesummary">
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'ID')?></th>
            <th><?php echo $this->Paginator->sort('name', 'NOMBRE')?></th>
            <th><?php echo $this->Paginator->sort('phone', 'TELEFONO')?></th>
            <th>DIRECCION</th>
            <th>OBSERVACIONES</th>
            <th>EDITAR</th>
        </tr>
        <?php foreach ($providers as $provider){ ?>
        <tr>
            <td><?php echo h($provider['Provider']['id']); ?></td>
            <td><?php echo h($provider['Provider']['name']); ?></td>
            <td><?php echo h($provider['Provider']['phone']); ?></td>
            <td><?php echo h($provider['Provider']['address']); ?></td>
            <td><?php echo h($provider['Provider']['observations']); ?></td>  
            <td><?php echo $this->Html->image('edit-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('action' => 'edit', $provider['Provider']['id'])
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