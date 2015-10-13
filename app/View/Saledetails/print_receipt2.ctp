<table>    
    <tr>
        <td id='title' colspan='3'> 
            <h2><?php echo $storedetail['Storedetail']['name']; ?></h2>
            <h3>NIT: <?php echo $storedetail['Storedetail']['nit']; ?> <br> 
                Tel&eacutefono: <?php echo $storedetail['Storedetail']['phone']; ?>  </h3>
        </td>
    </tr>
    <tr>
        <th>Cant.</th> 
        <th>Producto</th>
        <th>PrecioTot.</th>
    </tr>
    <tr>
        <td class ="leftAlign">-----</td>
        <td class = 'leftAlign'>-----------------------</td>
        <td class = 'rightAlign'>----------</td>
    </tr>               
        <?php        
            foreach ($saledetails as $detail){ ?>        
            <tr> 
                <td class ="leftAlign"> <?php  echo $detail['Saledetail']['amount']; ?></td>                
                <td class ="leftAlign"><span class ="prodName"> <?php  echo $detail['Product']['name']; ?> </span></td>               
                <td class ="rightAlign"> <?php  echo number_format($detail['Saledetail']['total_price'], 0, '.', '.'); ?></td> 
                
            </tr>
        <?php }?>           
    <tr>
        <td class ="leftAlign">-----</td>
        <td class = 'leftAlign'>-----------------------</td>
        <td class = 'rightAlign'>----------</td>
    </tr>
    <tr id ="totalReceipt">
        <td class = 'rightAlign' colspan='2'>TOTAL:</td>
        <td class = 'rightAlign'> 
            <?php
                $totalSale = 0;        
                foreach ($saledetails as  $detail) { $totalSale = $totalSale + $detail['Saledetail']['total_price']; }                
                echo number_format($totalSale, 0, '.', '.');               
            ?>
        </td>
    </tr>    
</table>
<br><br>
<div id ="footerReceipt">
    FECHA:  <?php echo  date("d/M/Y", strtotime($sal['Sale']['date'])); ?> 
    <br> <?php echo $storedetail['Storedetail']['regimenmessage']; ?> <br>
    <input type = "button" id="printRec" value = " Imprimir ">
    <input type = "button" id="goBack" value = " Regresar ">
</div>


