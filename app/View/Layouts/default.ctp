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
echo $this->Html->css(array('normalize', 'jquery-ui/jquery-ui', 'bootstrap.min', 'bootstrap-responsive.min', 'global', 'app'));
echo $this->Html->script(array('jquery','jquery-ui','bootstrap.min', 'app'));
echo $scripts_for_layout;
?>
</head>
<body>
	<?php echo $this->element('frontend/navigation')?>
	
	<div class="container">
		<?php
			echo $this->Session->flash();
			echo $this->fetch('content');
		?>
	</div>
    <footer role="footer" class="container footer">
        <div class="support-info">© 2013 JExam Beta Version.</div>
    </footer>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
