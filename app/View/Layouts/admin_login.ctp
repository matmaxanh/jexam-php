<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo $this->Html->meta('icon') ?>
<title><?php echo $title_for_layout; ?> - <?php echo 'Onlineworks System'; ?>
</title>
<?php
echo $this->Html->css(array('bootstrap.min', 'global', 'admin'));
echo $scripts_for_layout;
?>
</head>

<body>
	<?php echo $content_for_layout;?>
	<div id="footer">COPYRIGHT© OWS CO.,LTD ALL RIGHTS RESERVED.</div>
</body>
</html>
