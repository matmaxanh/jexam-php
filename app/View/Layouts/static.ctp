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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $title_for_layout; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
echo $this->Html->meta('icon');
echo $this->Html->css(array('normalize', 'bootstrap.min', 'bootstrap-responsive.min', 'jquery-ui/jquery-ui', 'global', 'static'));
echo $this->Html->script(array('jquery','jquery-ui','bootstrap.min'));
echo $scripts_for_layout;
?>
</head>
<body>
	<div class="navbar navbar-fixed-top">
        <div class="container">
            <div class="row">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="brand span3 center">
                    <?php echo $this->Html->link($this->Html->image('logo.png'), '/', array('escape' => false, 'id' => 'logo')) ?>
                </div>
                <div class="span9">
                    <div class="nav-button">
                        <?php echo $this->Html->link(__('Log In'), '/login', array('escape' => false, 'class' => 'btn btn-success')) ?>
                        <?php echo $this->Html->link(__('Register Now'), '/register', array('escape' => false, 'class' => 'btn btn-black')) ?>
                    </div>
                     <ul class="nav pull-right">
                        <li class="active">
                            <a href="#">About</a>
                        </li>
                        <li><a href="#">Feature</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</div>
    <div id="content" class="container"><?php echo $this->fetch('content') ?></div>
    <footer class="clearfix">
        <div class="container clearfix">
            <nav class="nav-footer clearfix">
                <li><a href="#">Features</a></li>
                <li><a href="#">Support</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Plans</a></li>
            </nav>
            <div class="buttons">
            </div>
        </div>
        <div class="bottom-links clearfix">
            <div class="container">
                <div class="copyright">
                    <p>© Copyright 2013 JExam |<a href="#"> Made by Me</a></p>
                    <p class="links"><a href="#" target="_blank">Terms of Service</a></p>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
//	var _urq = _urq || [];
//	_urq.push(['initSite', '6abf2b45-1bec-4e84-be95-820100d79099']);
//	(function() {
//	var ur = document.createElement('script'); ur.type = 'text/javascript'; ur.async = true;
//	ur.src = 'http://sdscdn.userreport.com/userreport.js';
//	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ur, s);
//	})();
	</script>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
