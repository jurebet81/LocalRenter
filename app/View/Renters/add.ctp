<div class="add">
     
    <fieldset>
       <legend>Nuevo Arrendatario</legend>  
           <?php echo $this->Form->create('Renter'); ?>
           <label>Nombre Completo:</label>
               <?php echo $this->Form->input('name', array('label' => '')); ?> <br>
           <label>C&eacute;dula o NIT:</label>
              <?php echo $this->Form->input('identification', array('label' => '')); ?> <br>                            
    </fieldset>
    <?php echo $this->Form->end(' Ingresar Arrendatario '); ?>
</div>