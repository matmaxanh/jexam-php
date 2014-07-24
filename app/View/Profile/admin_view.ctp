<?php
$this->start('toolbar');
echo $this->Html->link(
        '<i class="icon-ok icon-white"></i>&nbsp;' . __('Edit'), array('controller' => 'profile', 'action' => 'edit'), array('escape' => false, 'class' => 'btn btn-small btn-success')
);
$this->end();
$datetimeFormat = Configure::read('Setting.datetime_format');
?>
<div class="profile-detail form-horizontal">
    <div class="control-group">
        <div class="control-label"><?php echo __('Name') ?><span class="star">&nbsp;*</span></div>
        <div class="controls"><?php echo $user['User']['name'] ?></div>
    </div>
    <div class="control-group">
        <div class="control-label"><?php echo __('Username') ?><span class="star">&nbsp;*</span></div>
        <div class="controls"><?php echo $user['User']['username'] ?></div>
    </div>
    <div class="control-group">
        <div class="control-label"><?php echo __('Email') ?><span class="star">&nbsp;*</span></div>
        <div class="controls"><?php echo $user['User']['email'] ?></div>
    </div>
    <div class="control-group">
        <div class="control-label"><?php echo __('Register Date') ?></div>
        <div class="controls"><?php echo date($datetimeFormat, strtotime($user['User']['created'])) ?></div>
    </div>
    <div class="control-group">
        <div class="control-label"><?php echo __('Last Visit Date') ?></div>
        <div class="controls"><?php echo date($datetimeFormat, strtotime($user['User']['last_login_at'])) ?></div>
    </div>
</div>