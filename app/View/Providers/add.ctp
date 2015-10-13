<div class="add">
     
    <fieldset>
       <legend>Nuevo Proveedor</legend>
        
           <?php echo $this->Form->create('Provider');?>
           <label>Nombre:</label>
               <?php echo $this->Form->input('name', array('label' => ''));?> <br>
           <label>Tel&eacute;fono:</label>
               <?php echo $this->Form->input('phone', array('label' => ''));?> <br>
           <label>Direcci&oacute;n:</label>
               <?php echo $this->Form->input('address', array('label' => ''));?> <br>
           <label>Informaci&oacute;n Adicional:</label>
               <?php echo $this->Form->input('observations', array ('label' => ''));?>            
        
    </fieldset>
    <?php echo $this->Form->end(' Ingresar Proveedor '); ?>
</div>