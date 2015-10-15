<!DOCTYPE html>
<html lang='es'>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>	Inventario <?php //echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon', 'img/main-icon.png', array('type' => 'icon'));
		echo $this->Html->css(array(
			'ui-darkness/jquery-ui-1.10.4.custom','templatemo_style','ddsmoothmenu','style'));
		echo $this->Html->script(array(
			'ddsmoothmenu','jquery.min','jquery-1.6.1.min','jquery-1.10.2','jquery-ui-1.10.4.custom'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>    
        <script language="javascript" type="text/javascript">	
            ddsmoothmenu.init({
                mainmenuid: "templatemo_menu", //menu DIV id
                orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'ddsmoothmenu', //class added to menu's outer DIV                
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
            });
            
            $(document).ready(function(){                 
                $('input').attr('autocomplete','off');
            });
        </script>
</head>
<body>   
	<div id="templatemo_wrapper">            
            <div id="templatemo_header">				
					<table>
						<tr>
							<th>Tienda los primos</th>
						</tr>
						<tr>
							<th>NIT : 982389238923</th>
						</tr>
						<tr>
							<th>Tel&eacute;fono : 8415942</th>							
						</tr>						
					</table>				
                <div class="uName" ><?php echo AuthComponent::user('username') . ' ' .
                    $this->Html->link('Salir', array('controller' =>'users', 'action' => 'logout')) ;?>
				</div>               
            </div>           
        <div id="templatemo_menu" class="ddsmoothmenu">
            <ul>
                <li><?php echo $this->Html->link('Inicio', 
                         array('controller' =>'pages', 'action' => 'display','home'));?>
                </li>
                <li><?php echo $this->Html->link('Rentar', 
                         array('controller' =>'leases', 'action' => 'add'));?>
		</li>                
                <li><?php echo $this->Html->link('Gastos', 
                         array('controller' =>'expenses', 'action' => 'add'));?>
		</li>
                <li><?php echo $this->Html->link('Nuevo Apartam', 
                         array('controller' =>'apartments', 'action' => 'add'));?>
		</li>
                <li><?php echo $this->Html->link('Arrendatario', 
                         array('controller' =>'renters', 'action' => 'add'));?>
		</li>
                <li><?php echo $this->Html->link('Proveedores', 
                         array('controller' =>'providers', 'action' => 'add'));?>
		</li>                
               
                <li><?php 
                echo $this->Html->link('Reportes', array('controller' =>'#'));
                    // echo $this->Html->link('Reportes', array('controller' => $this->params['controller']));
                    ?>		               
                    <ul>
                        <li><?php echo $this->Html->link('Arrendos', 
                            array('controller' =>'leases', 'action' => 'view'));?>
                        </li> 
                        <li><?php echo $this->Html->link('Lotes', 
                            array('controller' =>'purchases', 'action' => 'index'));?>
                        </li> 
                        <li><?php echo $this->Html->link('Inventario / Productos', 
                            array('controller' =>'products', 'action' => 'view'));?>
                        </li>
                        <li><?php echo $this->Html->link('Clientes', 
                            array('controller' =>'clients', 'action' => 'view'));?>
                        </li> 
                        <li><?php echo $this->Html->link('Proveedores', 
                            array('controller' =>'providers', 'action' => 'view'));?>
                        </li> 
                        
                        
                    </ul> 
                </li> 
                 <li><?php echo $this->Html->link('Salir', 
                         array('controller' =>'users', 'action' => 'logout'));?>
		</li>
                
            </ul>
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
        
        <div  id="templatemo_main" >
            <section id ='render_cake'>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
            </section>
        </div>
</div>	
<?php //echo $this->element('sql_dump'); ?>
    
    <div id ="footer">        
        This site is © Copyright website 2014, all rights reserved. <br>
        <?php echo 'Designed by ' . $this->Html->link('Templatemo', 'http://www.templatemo.com/') . ' Free CSS Templates.'; ?><br>
        Adaptado y modificado por: Juli&aacute;n Restrepo B. 312 898 6803 julianrpo2711@hotmail.com.
    </div>
</body>
</html>
