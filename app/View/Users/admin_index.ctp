<?php
$this->start('box-header');
echo '<h2><i class="icon-user"></i><span class="break"></span>'.__('Members').'</h2>';
$this->end(); 
$this->start('toolbar');
if(isset($this->request->query['type']) && ($this->request->query['type'] === 'pupil')){
	echo $this->Layout->renderLink(
		'<i class="icon-upload-alt icon-white"></i>&nbsp;'.__('Import'),
		array('controller'=> 'users', 'action'=> 'import'),
		array('class'=> 'btn btn-small btn-info')
	);
}

echo $this->Layout->renderLink(
	'<i class="icon-plus icon-white"></i>&nbsp;'.__('Add new member'),
	array('controller'=> 'users', 'action'=> 'add'),
	array('class'=> 'btn btn-small btn-success')
);
echo $this->Layout->renderLink(
	'<i class="icon-remove"></i>&nbsp;'.__('Delete'),
	'javascript:;',
	array('id'=> 'btn_delete', 'class'=> 'btn btn-small btn-danger')
);
$this->end();
if(isset($this->request->query['type'])){
	$gridUrl = $this->Html->url(array(
		'controller'=> 'users',
		'action'=> 'grid',
		'?' => array('type' => $this->request->query['type'])
	));
}else{
	$gridUrl = $this->Html->url(array(
		'controller'=> 'users',
		'action'=> 'grid',
	));
}
?>
<div class="row-fluid">
<?php if(!empty($users)): ?>
<?php echo $this->Html->script(array('admin/grid'), array('inline'=> false))?>
<div id="userGrid" class="span12">
	<?php echo $this->element('backend/user_grid', compact('users'))?>
</div>
<script type="text/javascript">
	$('#userGrid').owsGrid({
		url: '<?php echo $gridUrl ?>',
		exportUrl: '<?php echo $this->Html->url(array('controller'=> 'users', 'action'=> 'export')); ?>',
		actions: {
			'delete': {'id': 'btn_delete', 'confirm': '<?php echo __('Are you sure you want to delete ?') ?>'}
		},
		pageVar: 'page',
		sortVar: 'sort',
		dirVar: 'direction',
		filterVar: 'question_filter',
		formFieldNameInternal: 'user',
		gridIds: '<?php echo implode("," ,$userIds) ?>'
	});
	var userGrid = $('#userGrid').data('owsGrid');
</script>
<?php else: ?>
<div class="alert">
  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No member in system.')?>
</div>
<?php endif ?>

</div>
