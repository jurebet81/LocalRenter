<div id = "ReceiptHeader">
	<table id = "StoreInfo">
		<tr>
                    <th id = 'StoreName' ><?php echo $storedetail['Storedetail']['name']; ?></th>		
		</tr>
		<tr> 
                    <td>NIT : <?php echo $storedetail['Storedetail']['nit']; ?></td>	
		</tr>
		<tr> 
                    <td>Tel&eacute;fono : <?php echo $storedetail['Storedetail']['phone']; ?></td>
		</tr>
		<tr> 
                    <td>Regimen : <?php echo $storedetail['Storedetail']['regimenmessage']; ?></td>
		</tr>
	</table>
	<table id = "ReceiptInfo">
		<tr> 
                    <th>FACTURA DE VENTA</th>						
		</tr>
		<tr> 
                    <th>000-0<?php echo $sale['Sale']['id']; ?></th>							
		</tr>					
		<tr>						
                    <td>Fecha : <?php echo  date("d/M/Y", strtotime($sale['Sale']['date'])); ?> </td>						
		</tr>
	</table>
	<br>
</div>
<table id = "CustomerInfo">
	<tr> 
            <td><span class = 'CustoTags'>Cliente: </span><?php echo $client['Client']['name']; ?></td>
            <td><span class = 'CustoTags'>CC o NIT: </span><?php echo $client['Client']['identification']; ?></td>		
        </tr>
	<tr> 
            <td><span class = 'CustoTags'>Direcci&oacute;n: </span><?php echo $client['Client']['address']; ?></td>
            <td><span class = 'CustoTags'>Tel&eacute;fono: </span><?php echo $client['Client']['phone']; ?></td>		
        </tr>
</table>
<br>				
<table id = "SaleInfo">
	<tr>
		<th id = 'Amount' >Cant.</th>
		<th>Art&iacute;culo</th>
		<th class = 'Values'>Valor Un.</th>
		<th class = 'Values'>Valor total</th>
	</tr>
        <?php $totalSale = 0; ?>        
	<?php foreach ($saledetails as $detail){ ?>   
        <?php $totalSale = $totalSale + $detail['Saledetail']['total_price']; ?>   
	<tr> 
		<td id = 'Amount'><?php  echo $detail['Saledetail']['amount']; ?></td>
		<td><?php  echo $detail['Product']['name']; ?> </td>
		<td class = 'Values'><?php  echo number_format($detail['Saledetail']['unit_price'], 0, '.', '.'); ?></td>
		<td class = 'Values'><?php  echo number_format($detail['Saledetail']['total_price'], 0, '.', '.'); ?></td>
	</tr>
	<?php }?> 
	<tr> <td>&nbsp;</td>	<td>&nbsp;</td>	 <td>&nbsp;</td> <td>&nbsp;</td></tr>
	<tr> <td>&nbsp;</td>	<td>&nbsp;</td>	 <td>&nbsp;</td> <td>&nbsp;</td></tr>
	<tr id = 'SpecialRow'> 
            <td>&nbsp;</td>	<td>&nbsp;</td>	 <td>&nbsp;</td> <td>&nbsp;</td>
        </tr>
	<tr class = 'TotalValues'>
		<td  colspan ="3" >SubTotal: </td>
		<td class = 'Values' ><?php echo number_format($totalSale * 0.84, 0, '.', '.'); ?></td>
	</tr>
	<tr class = 'TotalValues'>
		<td colspan ="3" >IVA 16%: </td>
		<td class = 'Values'><?php echo number_format($totalSale * 0.16, 0, '.', '.'); ?></td>
	</tr>
	<tr class = 'TotalValues'>
		<td colspan ="3" >Total: </td>
		<td class = 'Values'><?php  echo number_format($totalSale, 0, '.', '.'); ?></td>
	</tr>
</table>						
<div id ="footerReceipt">
    <br>
    <input type = "button" id="printRec" value = " Imprimir ">
    <input type = "button" id="goBack" value = " Regresar ">
</div>
