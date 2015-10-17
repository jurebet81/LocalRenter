<div class="view">
    
    <h3>LISTA DE UTILIDADES</h3>
    <table class ="tablesummary">
        <tr>
            <th>MES/A&Ntilde;O</th>
            <th>PAGOS RECIBIDOS</th>
            <th>GASTOS</th>            
            <th>TOTAL UTILIDADES</th> 
            
        </tr>
    
        <?php $totalExpenses = 0; ?>
        <?php $totalPayments = 0; ?>
        <?php $totalProfits = 0; ?>
        
        <?php foreach ($profits as $profit){ ?>  
            <?php $keyMonth = key($profit); ?>
        <tr> 
            <td> <?php echo $keyMonth; ?></td>
            <td> <?php echo number_format($profit[$keyMonth]['Payments'], 0, '.', '.'); ?></td>
            <td> <?php echo number_format($profit[$keyMonth]['Expenses'], 0, '.', '.'); ?></td> 
            <td  id="pesosValue"> <?php echo number_format($profit[$keyMonth]['Profits'], 0, '.', '.'); ?></td>          
            
        </tr>
        <?php 
            $totalPayments += $profit[$keyMonth]['Payments'];
            $totalExpenses += $profit[$keyMonth]['Expenses'];
            $totalProfits += $profit[$keyMonth]['Profits'];
        } ?>
        <tr>             
            <td id ='totalvalue'> 
                Totales
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalPayments, 0, '.', '.'); ?> </div>
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalExpenses, 0, '.', '.'); ?> </div>
            </td>
            <td id ='totalvalue'>
                <div id = "pesosValue"><?php echo number_format($totalProfits, 0, '.', '.'); ?> </div>
            </td>                   
        </tr>
    </table>
        
</div>