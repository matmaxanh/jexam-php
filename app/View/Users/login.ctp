<div class="row">
    <div class="span4 offset4">
        <div id="loginForm" class="well">
            <h2 class="center"><?php echo __('Login'); ?></h2>
		<?php echo $this->Session->flash() ?>
            <?php echo $this->Form->create('User', array(
                        'url' => array('controller' => 'users', 'action' => 'login'), 
                        'inputDefaults' => array('label' => false, 'div' => false)
            ));?>
            <div class='control-group'>
                <?php echo $this->Form->input('username',array('id' => 'username', 'class' => 'input-medium', 'placeholder' => __('Username or Email')))?>
            </div>
            <div class='control-group'>
                <?php echo $this->Form->input('password',array('id' => 'password', 'class' => 'input-medium', 'placeholder' => __('Password'))) ?>
            </div>

            <div><?php echo $this->Form->button(__('Enter'), array('class' => 'btn btn-success')); ?></div>
            <?php echo $this->Form->end();?>
            <?php echo $this->Html->link(__('Forgot password'), array('controller' => 'users','action' => 'forgot',), array('class' => 'right green')); ?>
            <div class="clearfix"></div>
        </div>
        <div class="center" style="margin-bottom:15%">
        	Don't have an account? Join the&nbsp;
        	<?php echo $this->Html->link(__('Register now'), '/register', array('class' => 'green', 'id' => 'registerLink')) ?>
        </div>
    </div>
</div>
