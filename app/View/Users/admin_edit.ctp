<?php
echo $this->Html->script(array('jquery.checkboxtree'), array('inline'=> false));
echo $this->Html->css(array('jquery.checkboxtree'),null, array('inline'=> false));
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
	array('controller'=> 'users', 'action'=> 'index'),
	array('escape'=> false, 'class'=> 'btn btn-small')
);
$this->end();
$datetimeFormat = Configure::read('Setting.datetime_format');
?>
<?php echo $this->Form->create('User', array('id'=> 'user_form', 'class'=> 'form-validate form-horizontal', 'inputDefaults'=> array('div'=> false, 'label'=> false))) ?>
<div class="control-group">
	<div class="control-label"><?php echo __('Name') ?><span class="star">&nbsp;*</span></div>
	<div class="controls"><?php echo $this->Form->input('name') ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Username') ?><span class="star">&nbsp;*</span></div>
	<div class="controls"><?php echo $this->Form->input('username') ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Password') ?></div>
	<div class="controls"><?php echo $this->Form->password('passwd') ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Password Confirm') ?></div>
	<div class="controls"><?php echo $this->Form->password('passwd_confirm') ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Email') ?><span class="star">&nbsp;*</span></div>
	<div class="controls"><?php echo $this->Form->input('email') ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Role') ?><span class="star">&nbsp;*</span></div>
	<div class="controls"><?php echo $this->Form->select('role_id', $roles, array('empty'=> false, 'value'=> $this->data['User']['role_id'])) ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Register Date') ?></div>
	<div class="controls"><?php echo $this->Form->input('created', array('type'=> 'text', 'class'=> 'readonly', 'readonly'=> true, 'value'=> date($datetimeFormat, strtotime($this->data['User']['created'])))) ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Last Visit Date') ?></div>
	<div class="controls"><?php echo $this->Form->input('last_login_at', array('type'=> 'text', 'class'=> 'readonly', 'readonly'=> true, 'value'=> date($datetimeFormat, strtotime($this->data['User']['last_login_at'])))) ?></div>
</div>
<div class="control-group">
	<div class="control-label"><?php echo __('Status') ?></div>
	<div class="controls"><?php echo $this->Form->select('status', Configure::read('Constant.status'), array('empty'=> false)) ?></div>
</div>
<?php echo $this->Form->hidden('task', array('id'=> 'task'))?>
<?php echo $this->Form->end() ?>
<script type="text/javascript">
$("#groups > .control-group > .controls > ul").checkboxTree({
    onCheck: {
    	ancestors:'checkIfFull',
    	descendants: 'check'
    },
    onUncheck: {
        ancestors: 'uncheck'
    }
});
OWS.submitbutton = function(task) {
	OWS.submitform(task, document.getElementById('user_form'));
};
</script>