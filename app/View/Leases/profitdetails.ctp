<div class="view">
    
    <h3>LISTA DE UTILIDADES</h3>
    <table class ="tablesummary">
        <tr>
            <th>MES/A&Ntilde;O</th>
            <th>VENTAS</th>
            <th>LOTES</th>            
            <th>TOTAL UTILIDADES</th> 
            
        </tr>
    
        <?php $totalSales = 0; ?>
        <?php $totalPurchases = 0; ?>
        <?php $totalProfits = 0; ?>
        
        <?php foreach ($profits as $profit){ ?>  
            <?php $keyMonth = key($profit); ?>
        <tr> 
            <td> <?php echo $keyMonth; ?></td>
            <td> <?php echo number_format($profit[$keyMonth]['Sales'], 0, '.', '.'); ?></td>
            <td> <?php echo number_format($profit[$keyMonth]['Purchases'], 0, '.', '.'); ?></td> 
            <td  id="pesosValue"> <?php echo number_format($profit[$keyMonth]['Profits'], 0, '.', '.'); ?></td>          
            
        </tr>
        <?php 
            $totalSales += $profit[$keyMonth]['Sales'];
            $totalPurchases += $profit[$keyMonth]['Purchases'];
            $totalProfits += $profit[$keyMonth]['Profits'];
        } ?>
        <tr>             
            <td id ='totalvalue'> 
                Totales
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalSales, 0, '.', '.'); ?> </div>
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalPurchases, 0, '.', '.'); ?> </div>
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalProfits, 0, '.', '.'); ?> </div>
            </td>                   
        </tr>
    </table>
        
</div>