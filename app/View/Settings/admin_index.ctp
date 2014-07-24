<h2><?php echo __('Synchronize Database')." : " ?></h2>
<?php 
echo $this->Html->link('<i class="icon-refresh icon-white"></i>&nbsp;'.__('synchronize'), 
	array('controller' => 'sync', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-success'));
?>