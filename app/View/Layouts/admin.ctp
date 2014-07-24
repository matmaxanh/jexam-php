<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $title_for_layout; ?> - <?php echo 'OWS'; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
echo $this->Html->meta('icon');
echo $this->Html->script(array('jquery','jquery-ui','bootstrap.min', 'admin'));
echo $this->Html->css(array('jquery-ui/jquery-ui', 'bootstrap.min','bootstrap-responsive.min', 'font-awesome.min', 'global', 'admin'));
echo $scripts_for_layout;
?>
<!--[if IE 7]>
    <?php echo $this->Html->css('font-awesome-ie7.min.css'); ?>
<![endif]-->
</head>
<body>
    <noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading"><?php echo __('Warning!') ?></h4>
        <p><?php echo __('You need to have %s enabled to use this site.', $this->Html->link('Javascript', 'http://en.wikipedia.org/wiki/JavaScript', array('target' => '_blank'))) ?></p>
    </div>
    </noscript>
	<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php echo $this->Html->link('<strong>JExam Admin</strong>', '/', array('escape' => false, 'class' => 'brand')) ?>
								
                <ul class="nav nav-sidebar pull-right">

                    <li class="grey user-profile">
                        <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                            <i class="icon-picture"></i>
                            <span id="user_info">
                                <?php echo $this->Session->read('Auth.User.username')?>
                            </span>

                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
                            <li>
                                <?php echo $this->Html->link('<i class="icon-user"></i>&nbsp;'.__('Profile'), array('controller' => 'profile', 'action' => 'view'), array('escape' => false)) ?>
                            </li>

                            <li class="divider"></li>
                            <li>
                                <?php echo $this->Html->link('<i class="icon-off"></i>'.__('Logout'), array('plugin' => false, 'controller' => 'users', 'action' => 'logout'), array('escape' => false))?>
                            </li>
                        </ul>
                    </li>
                </ul>
				<!-- end: Header Menu -->
			</div>
		</div>
	</div>
	<!-- end: Header -->
	<div class="container-fluid" id="main-container">
        <a id="menu-toggler" href="#"><span></span></a>
        <!-- start: Navigation -->
        <div id="sidebar">
            <?php echo $this->element('backend/navigation') ?>
        </div>
        <!-- end: Navigation -->
        
        <div id="main-content" class="clearfix">
            <div id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="#"><?php echo __('Home') ?></a>

                        <span class="divider">
                            <i class="icon-angle-right"></i>
                        </span>
                    </li>
                </ul><!--.breadcrumb-->

            </div>
            <?php echo $this->Session->flash(); ?>	
            <!-- start: Content -->
            <div id="page-content" class="clearfix">
                <div class="page-header">
                    <?php echo $this->fetch('box-header') ?>
                    <div class="pull-right btn-action" style="line-height: 40px;"><?php echo $this->fetch('toolbar') ?></div>
                </div>
                <div class="row-fluid">
                    <?php echo $this->fetch('content') ?>
                </div>
            </div>
        </div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
