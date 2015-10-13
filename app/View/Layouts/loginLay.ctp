<!DOCTYPE html>
<html lang='es'>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Login</title>
	<?php
		echo $this->Html->meta('icon', 'img/main-icon.png', array('type' => 'icon'));
		echo $this->Html->css(array(
			'login-style'));		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>    
        
</head>
<body>
        <div class="inset">
            <?php echo $this->fetch('content'); ?>
            <?php echo $this->Session->flash(); ?>
        </div>
</body>
</html>
