<div class="view">
    
    <h3>LISTA DE GASTOS</h3>
    <table class ="tablesummary">
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'ID')?></th>
            <th><?php echo $this->Paginator->sort('Apto.name', 'APARTAMENTO')?></th>
            <th>POR CONCEPTO DE:</th> 
            <th><?php echo $this->Paginator->sort('amount', 'VALOR')?></th>
            <th><?php echo $this->Paginator->sort('date', 'FECHA')?></th>                      
            <th>ACCIONES</th>            
        </tr>
        <?php $totalExpenses = 0; ?>
        
        <?php foreach ($expenses as $expense){ ?>
        <tr>
            <td><?php echo h($expense['Expense']['id']); ?></td>
            <td><?php echo h($expense['Apto']['name']); ?></td>   
            <td><?php echo h($expense['Expense']['description']); ?></td>  
            <td><?php echo h($expense['Expense']['date']); ?></td>   
            <td><?php echo number_format(h($expense['Expense']['amount']), 0, '.', '.');  ?></td>          
            <td>
            	<?php echo $this->Html->image('edit-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Expenses', 'action' => 'edit', $expense['Expense']['id'])
                         ));
                 ?> <span class="CloseExpenseImg">                 
            	<?php echo $this->Html->image('delete-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Expenses', 'action' => 'remove', $expense['Expense']['id'])
                    
                         ));
                ?>       </span>
            </td>
        </tr>
        <?php 
            $totalExpenses += h($expense['Expense']['amount']);
        } ?>
        <tr> 
            <td></td><td></td><td></td>
            <td id ='totalvalue'> 
                Total
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalExpenses, 0, '.', '.'); ?> </div>
            </td>
            <td></td>        
        </tr>
    </table>
    <p class ="infoPag"> 
        <?php echo $this->Paginator->counter(
                array('format' => 'PÃ¡gina {:page} de {:pages}, mostrando {:current} registros de {:count}') //paginacion
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
                	var answer = confirm("¿Esta Seguro que desea eliminar el gasto?"); 
                	if (answer==false){
                	    return false;
                	}                	                
            	});  
                   
            });
           
</script>

 