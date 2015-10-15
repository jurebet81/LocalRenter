<div class="add">        
     
    <fieldset>    
       <legend>Ingresar Pago</legend>  
       		<?php echo $this->Form->create('Payment');?>
       <table>
       		<tr>
       			<td>
       				<label>Apartamento: </label>
       				<?php echo $this->Form->input('apartament', array('label' => '', 'readonly' => 'readonly',
       						'default'=>$contract['Apartament']['name']));?>        			
       			</td>
       			<td>
       				<label>Pago desde: </label>
       				<?php echo $this->Form->input('from_date', array('type' => 'text', 'label' => '', 'readonly' => 'readonly',
       						'default'=>$contract['Lease']['last_payment_date']));?> 
       			</td>
       		</tr>   
       		<tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>    
       		<tr>
       			<td>
       			<label>Inquilino: </label>
               <?php echo $this->Form->input('holder_name', array('label' => '', 'readonly' => 'readonly',
               		'default'=>$contract['Lease']['holder_name']));?>
               </td>
               <td>
       				<label>Pago hasta: </label>
       				<?php 
       					$init_date = strtotime($contract['Lease']['last_payment_date']);
       					$to_date = strtotime("+1 month",$init_date);       				
       				?> 
       				<?php echo $this->Form->input('to_date', array( 'type' => 'text', 'label' => '', 'readonly' => 'readonly',
       						'default'=>date('Y-m-d',$to_date)));?> 
       			</td>
       		</tr>       		
       		<tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>        		
       		<tr>
       			<td>
       			<label>Monto a pagar: </label>
               <?php echo $this->Form->input('amount', array('label' => '', 
               		'default'=>$contract['Lease']['amount']));?>
               </td>               
       		</tr>
       		<tr> <td> <label> </label></td> <td> <label> </label> </td> </tr> 
       		<tr>
       			<td>
       			<label>Observaciones</label>
               <?php echo $this->Form->input('observations', array('label' => ''));?>
               </td>               
       		</tr>
       		
       		<tr>
       			<td>
       			<?php echo $this->Form->hidden('lease_id', array ('value' => $contract['Lease']['id']));?>
       			<?php echo $this->Form->end(' Guardar e Imprimir '); ?>
               </td>               
       		</tr>
                       
        </table>
        
    </fieldset>
    
</div>