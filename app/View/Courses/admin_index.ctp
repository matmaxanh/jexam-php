<?php
$this->start('box-header');
echo '<h2><i class="icon-list-alt"></i><span class="break"></span>'.__('Course').'</h2>';
$this->end(); 
$this->start('toolbar');
echo $this->Layout->renderLink(
	'<i class="icon-plus icon-white"></i>&nbsp;'.__('Add new course'),
	array('controller'=> 'courses', 'action'=> 'add'),
	array('class'=> 'btn btn-small btn-success')
);
echo $this->Layout->renderLink(
	'<i class="icon-remove"></i>&nbsp;'.__('Delete'),
	'javascript:;',
	array('id'=> 'btn_delete', 'class'=> 'btn btn-small btn-danger')
);
$this->end();
?>
<div class="row-fluid">
<?php if(isset($courses) && !empty($courses)): ?>
<?php echo $this->Html->script(array('admin/grid'), array('inline'=> false))?>
<div id="courseGrid" class="span12">
	<?php echo $this->element('backend/course_grid', compact('courses'))?>
</div>
<script type="text/javascript">
	$('#courseGrid').owsGrid({
		url: '<?php echo $this->Html->url(array('controller'=> 'courses', 'action'=> 'grid')); ?>',
		exportUrl: '<?php echo $this->Html->url(array('controller'=> 'users', 'action'=> 'export')); ?>',
		actions: {
			'delete': {'id': 'btn_delete', 'confirm': '<?php echo __('Are you sure you want to delete ?') ?>'}
		},
		pageVar: 'page',
		sortVar: 'sort',
		dirVar: 'direction',
		filterVar: 'course_filter',
		formFieldNameInternal: 'course',
		gridIds: '<?php echo implode("," ,$courseIds) ?>'
	});
	var courseGrid = $('#courseGrid').data('owsGrid');
</script>
<?php else: ?>
<div class="alert">
  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No course in system.')?>
</div>
<?php endif ?>

</div>

