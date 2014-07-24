<div class="row-fluid login-wrapper">
    <div class="logo"><?php echo $this->Html->image('logo-white.png'); ?></div>
    <?php echo $this->Form->create('User', array(
            'url' => array('controller' => 'users', 'action' => 'login'), 
            'inputDefaults' => array('div' => false, 'label' => false)
    ));?>
    <div class="login-box">
        <div class="login-box-title"><?php echo __('Login') ?></div>
        <div class="login-box-content">
            <?php echo $this->Session->flash() ?> 
            <?php
            echo '<p>'.__('Username').'</p>';
            echo $this->Form->input('username', array('class' => 'span12'));
            echo '<p>'.__('Password').'</p>';
            echo $this->Form->password('password', array('class' => 'span12'));
            echo $this->Html->link(__('Forgot password?'), array('controller' => 'users', 'action' => 'forgot'), array('class'=> 'forgot'));
            ?>
            <div class="remember">
                <?php echo $this->Form->checkbox('remember_me', array('hiddenField' => false)); ?>
                <?php echo $this->Form->label(__('Remember me')) ?>
            </div>
            <?php echo $this->Form->button(__('Log In'), array('class' => 'btn btn-login login'))?>
            <?php echo $this->Form->end();?>
        </div>
    </div>
    
</div>
		
