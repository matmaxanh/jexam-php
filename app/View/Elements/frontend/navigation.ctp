<?php
$menus = array(
    array('title' => __('Dashboard'), 'url' => array('controller' => 'users', 'action' => 'dashboard')),
    array('title' => __('Exam'), 'url' => '/exam'),
);
?>
<div class="header">
    <div class="container navbar">
        <ul class="inline span8">
            <?php foreach($menus as $k => $link){
                $class = 'navtab';
                if(($this->params['controller'] == $link['url']['controller']) && ($this->params['action'] == $link['url']['action'])){
                    $class .= ' active';
                }
                echo '<li>'.$this->Html->link($link['title'], $link['url'], array('class' => $class)).'</li>'; 
            }?>
        </ul>
        <div class="navbar-profile-wrap">
            <ul class="inline pull-right navbar-icons">
                <li>
                    <a href="#" class="nav-icon nav-icon-mail"
                       title="Mail"></a>
                </li>
                <li>
                    <a href="#" class="nav-icon nav-icon-notification"
                       title="Notifications"></a>
                </li>
                <li><a href="#" class="nav-icon nav-icon-setting"
                       title="Settings"></a>
                </li>
                <li>
                    <a href="#" class="nav-icon nav-icon-help"
                       title="Help"></a>
                </li>
            </ul>
            <div class="navbar-profile pull-right">
                <?php echo $this->Html->link($this->Session->read('Auth.User.username') . '&nbsp;<span class="caret"></span>', '#', array('escape' => false, 'class' => 'dropdown-toggle navbar-username', 'data-toggle' => 'dropdown'))
                ?>
                <ul class="dropdown-menu">
                    <li><?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'profile')) ?></li>
                    <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nav-tab-panel">
        <nav role="navigation" class="container">
            <ul class="subnavbar">
            </ul>
        </nav>
    </div>
</div>
