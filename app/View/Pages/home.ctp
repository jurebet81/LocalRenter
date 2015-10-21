<?php
	$this->layout = 'home';       
?>

<h1 id="homemessage">Aplicaci&oacute;n de registro y control de arrendamientos</h1> <br>
<h2>Bienvenido <?php echo AuthComponent::user('username')?></h2>
<h2>Pagos pendientes : </h2>

<div class="view">
    
    <h3>REPORTE DE APARTAMENTOS</h3>
    <table class ="tablesummary">
        <tr>
            <th>CONTRATO No</th>
            <th>INQUILINO</th>
            <th>APARTAMENTO</th>            
            <th>VALOR CONTRATO</th> 
            <th>PAGO_HASTA</th>                       
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
                    array ('controller' => 'Leases', 'action' => 'printContract', $lease['Lease']['id'])
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
     
    
</div>