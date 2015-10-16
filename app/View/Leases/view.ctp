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
        <?php $today = date("Y-m-d");?>
        <?php foreach ($leases as $lease){ ?>
        <tr>
            <td> <?php echo h($lease['Lease']['id']); ?></td>
            <td> <?php echo h($lease['Lease']['holder_name']); ?></td>
            <td> <?php echo h($lease['Apto']['name']); ?></td>  
            <?php if ($today >= h($lease['Lease']['last_payment_date'])) {?>           
	            <td class='expiredpayment'> <?php echo number_format(h($lease['Lease']['amount']), 0, '.', '.'); ?></td> 
	            <td class='expiredpayment'> <?php echo h($lease['Lease']['last_payment_date']); ?></td>   
            <?php } else { ?>
	            <td class='uptodatepayment'> <?php echo number_format(h($lease['Lease']['amount']), 0, '.', '.'); ?></td> 
	            <td class='uptodatepayment'> <?php echo h($lease['Lease']['last_payment_date']); ?></td>   
	        <?php } ?>                          
            <td>
                 <?php echo $this->Html->image('payment-icon.png', array ("alt" =>"CakePHP", 'url' =>
                    array ('controller' => 'Payments', 'action' => 'add', $lease['Lease']['id']),                    
                         ));
                 ?> 
                <?php echo $this->Html->image('edit-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Leases', 'action' => 'edit', $lease['Lease']['id'])
                         ));
                ?>          
                <?php echo $this->Html->image('printer-icon.png', array ('alt' =>'CakePHP', 'url' =>
                    array ('controller' => 'Leases', 'action' => 'download', $lease['Lease']['id'])
                         ));
                ?> <span class="CloseContractImg">                                        
                 <?php echo $this->Html->image('delete-icon.png', array ("alt" =>"CakePHP", 'url' =>
                    array ('controller' => 'Leases', 'action' => 'close', $lease['Lease']['id']),                    
                         ));
                 ?>
                 	</span> 
            </td>
        </tr>
        <?php } ?>
        
    </table>
    <p class ="infoPag"> 
        <?php echo $this->Paginator->counter(
                array('format' => 'PÃ¡gina {:page} de {:pages}, mostrando {:current} registros de {:count}') //paginacion                
            );
        ?>
    </p>
    
    <div class='pagination'>
        <?php echo $this->Paginator->prev('Anterior', array(), null, array('class' => 'disabled'));?>
        <?php echo $this->Paginator->numbers(array('separator' => '')); ?>
        <?php echo $this->Paginator->next('Siguiente', array(), null, array ('class' => 'disabled'));?>        
    </div>   
    
</div>

<script language="javascript" type="text/javascript">		
             $(document).ready(function() {             	
                $('.CloseContractImg').click(function(){                                        
                	var answer = confirm("¿Esta Seguro que desea cerrar el contrato?"); 
                	if (answer==false){
                	    return false;
                	}                	                
            	});  
                   
            });
           
</script>