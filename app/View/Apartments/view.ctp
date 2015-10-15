<div class="view">
    
    <h3>REPORTE DE APARTAMENTOS</h3>
    <table class ="tablesummary">
        <tr>
            <th><?php echo $this->Paginator->sort('Apartment.id','ID'); ?></th>
            <th><?php echo $this->Paginator->sort('Locat.name','UBICACION'); ?></th>
            <th><?php echo $this->Paginator->sort('Apartment.name','NOMBRE'); ?></th>
            <th>DIRECCI&Oacute;N</th>
            <th><?php echo $this->Paginator->sort('Apartment.rent_price','PRECIO_ARR.'); ?></th>
            <th><?php echo $this->Paginator->sort('Apartment.available','DISPONIBLE'); ?></th>
            <th>EDITAR</th>            
        </tr>
        <?php foreach ($apartments as $apartment){ ?>
        <tr>
            <td><?php echo h($apartment['Apartment']['id']); ?></td>
            <td><?php echo h($apartment['Locat']['name']); ?></td>
            <td><?php echo h($apartment['Apartment']['name']); ?></td>
            <td><?php echo h($apartment['Apartment']['address']); ?></td>
            <td><?php echo number_format(h($apartment['Apartment']['rent_price']), 0, '.', '.'); ?></td>
            <td><?php echo h($apartment['Apartment']['available']); ?></td>
            <td><?php echo $this->Html->image('edit-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('action' => 'edit', $apartment['Apartment']['id'])
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