<div class="view">
    
    <h3>LISTA DE PAGOS</h3>
    <table class ="tablesummary">
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'ID')?></th>
            <th><?php echo $this->Paginator->sort('Apto.name', 'APARTAMENTO')?></th>
            <th>INQUILINO:</th>
            <th><?php echo $this->Paginator->sort('date', 'FECHA_PAGO')?></th>
            <th><?php echo $this->Paginator->sort('amount', 'VALOR')?></th>            
            <th><?php echo $this->Paginator->sort('from_date', 'FECHA_INICIAL')?></th>  
            <th><?php echo $this->Paginator->sort('to_date', 'FECHA_FINAL')?></th>  
            <th>ACCIONES</th>            
        </tr>
        <?php $totalPayments = 0; ?>
        
        <?php foreach ($payments as $payment){ ?>
        <tr>
            <td><?php echo h($payment['Payment']['id']); ?></td>
            <td><?php echo h($payment['Apto']['name']); ?></td>  
            <td><?php echo h($payment['L']['holder_name']); ?></td>  
            <td><?php echo h($payment['Payment']['date']); ?></td> 
            <td><?php echo number_format(h($payment['Payment']['amount']), 0, '.', '.');  ?></td>
            <td><?php echo h($payment['Payment']['from_date']); ?></td>  
            <td><?php echo h($payment['Payment']['to_date']); ?></td>  
            <td>
            	<?php echo $this->Html->image('printer-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Payments', 'action' => 'print', $payment['Payment']['id'])
                         ));
                 ?> <span class="CloseExpenseImg">                 
            	<?php echo $this->Html->image('delete-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Payments', 'action' => 'remove', $payment['Payment']['id'])
                    
                         ));
                ?></span>
            </td>
        </tr>
        <?php 
            $totalPayments += h($payment['Payment']['amount']);
        } ?>
        <tr> 
            <td></td><td></td><td></td>
            <td id ='totalvalue'> 
                Total
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalPayments, 0, '.', '.'); ?> </div>
            </td>
            <td></td> <td></td>  <td></td>       
        </tr>
    </table>
    <p class ="infoPag"> 
        <?php echo $this->Paginator->counter(
                array('format' => 'Página {:page} de {:pages}, mostrando {:current} registros de {:count}') //paginacion
            );
        ?>
    </p>    
    
    <?php //echo $this->element('sql_dump');?>
    <div class='pagination'>
        
        <?php echo $this->Paginator->prev('Anterior', array(), null, array('class' => 'disabled'));?>
        <?php echo $this->Paginator->numbers(array('separator' => '')); ?>
        <?php echo $this->Paginator->next('Siguiente', array(), null, array ('class' => 'disabled'));?>        
    </div>    
    
</div>

<script language="javascript" type="text/javascript">		
             $(document).ready(function() {             	
                $('.CloseExpenseImg').click(function(){                                        
                	var answer = confirm("�Esta Seguro que desea eliminar el gasto?"); 
                	if (answer==false){
                	    return false;
                	}                	                
            	});  
                   
            });
           
</script>

 