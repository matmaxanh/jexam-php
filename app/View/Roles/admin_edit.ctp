<?php 
$this->start('box-header');
echo '<h2><i class="icon-list-alt"></i><span class="break"></span>'.__('Edit role').'</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link(
	'<i class="icon-ok icon-white"></i>&nbsp;'.__('Save'),
	'javascript:;',
	array('escape'=> false, 'class'=> 'btn btn-small btn-success', 'onclick'=> "OWS.submitbutton('save')")
);
echo $this->Html->link(
	'<i class="icon-plus"></i>&nbsp;'.__('Save & New'),
	'javascript:;',
	array('escape'=> false, 'class'=> 'btn btn-small btn-info', 'onclick'=> "OWS.submitbutton('save2new')")
);
echo $this->Html->link(
	'<i class="icon-remove"></i>&nbsp;'.__('Cancel'),
	array('controller'=> 'roles', 'action'=> 'index'),
	array('escape'=> false, 'class'=> 'btn btn-small')
);
$this->end() ?>
<div class="roles form">
<?php echo $this->Form->create('Role', array(
	'id'=> 'role_form',
	'class'=> 'form-validate form-horizontal',
	'inputDefaults'=> array('label'=> false, 'div'=> 'controls'),
));
echo $this->Form->hidden('id');
echo $this->Form->hidden('task', array('id'=> 'task'));
?>
	<fieldset>
		<div class="control-group">
			<div class="control-label">
				<label class="hasTip required">
					<?php echo __('Role Title')?>
					<span class="star">*
				</label>
			</div>
			<?php echo $this->Form->input('name');?>
		</div>
		<div class="control-group">
			<div class="control-label">
				<label class="hasTip required">
					<?php echo __('Role Parent')?>
					<span class="star">*
				</label>
			</div>
			<div class="controls">
				<?php echo $this->Form->select('parent_id', $roles);?>
			</div>
		</div>
		
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
OWS.submitbutton = function(task) {
	OWS.submitform(task, document.getElementById('role_form'));
};
</script>
