<h1><?php echo __('We\'re sorry...') ?></h1>
<p>
	<?php echo __('Error'); ?>
	<?php echo __('An Internal Error Has Occurred.'); ?>
</p>
<?php echo $this->Html->image('face_sad.gif')?>
<p>
	<?php echo $this->Html->link(__('Return to the homepage'), '/')?>
</p>
<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>


