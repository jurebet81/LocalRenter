<div class="add">        
     
    <fieldset>    
       <legend>Ingresar Pago</legend>  
       		<?php echo $this->Form->create('Payment');?>
       <table>
       		<tr>
       			<td>
       				<label>APARTAMENTO: </label>
       				<?php echo $this->Form->input('apartment', array('label' => '', 'readonly' => 'readonly',
       						'default'=>$contract['Apartment']['name']));?>        			
       			</td>
       			<td>
       				<label>PAGO DESDE: </label>
       				<?php echo $this->Form->input('from_date', array('type' => 'text', 'label' => '', 'readonly' => 'readonly',
       						'default'=>$contract['Lease']['last_payment_date']));?> 
       			</td>
       		</tr>   
       		<tr> <td> <label> </label></td> <td> <label> </label> </td> </tr>    
       		<tr>
       			<td>
       			<label>INQUILINO: </label>
               <?php echo $this->Form->input('holder_name', array('label' => '', 'readonly' => 'readonly',
               		'default'=>$contract['Lease']['holder_name']));?>
               </td>
               <td>
       				<label>PAGO HASTA: </label>
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
       			<label>MONTO A PAGAR: </label>
               <?php echo $this->Form->input('amount', array('label' => '', 
               		'default'=>$contract['Lease']['amount']));?>
               </td> 
               <td>
               	<label>RECIB&Iacute;: </label>
               	<?php echo $this->Form->input('paid_to', array('label' => '', 'readonly' => 'readonly',
               		'default'=> AuthComponent::user('username')));?>
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