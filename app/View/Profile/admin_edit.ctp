<?php
$this->start('toolbar');
echo $this->Html->link(
	'<i class="icon-ok icon-white"></i>&nbsp;'.__('Save'),
	'javascript:;',
	array('escape'=> false, 'class'=> 'btn btn-small btn-success', 'onclick'=> "OWS.submitbutton('save')")
);
echo $this->Html->link(
	'<i class="icon-remove"></i>&nbsp;'.__('Cancel'),
	array('controller'=> 'profile', 'action'=> 'view'),
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
    <div class="control-label"><?php echo __('Register Date') ?></div>
    <div class="controls"><?php echo $this->Form->input('created', array('type'=> 'text', 'class'=> 'readonly', 'readonly'=> true, 'value'=> date($datetimeFormat, strtotime($this->data['User']['created'])))) ?></div>
</div>
<div class="control-group">
    <div class="control-label"><?php echo __('Last Visit Date') ?></div>
    <div class="controls"><?php echo $this->Form->input('last_login_at', array('type'=> 'text', 'class'=> 'readonly', 'readonly'=> true, 'value'=> date($datetimeFormat, strtotime($this->data['User']['last_login_at'])))) ?></div>
</div>
<?php echo $this->Form->hidden('task', array('id'=> 'task'))?>
<?php echo $this->Form->end() ?>
<script type="text/javascript">
OWS.submitbutton = function(task) {
	OWS.submitform(task, document.getElementById('user_form'));
};
</script>