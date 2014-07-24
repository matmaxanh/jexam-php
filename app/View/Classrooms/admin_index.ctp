<?php
$this->start('box-header');
echo '<h2><i class="icon-list-alt"></i><span class="break"></span>'.__('Manage class').'</h2>';
$this->end(); 
$this->start('toolbar');
echo $this->Layout->renderLink(
	'<i class="icon-plus icon-white"></i>&nbsp;'.__('Add new class'),
	array('controller'=> 'classrooms', 'action'=> 'add'),
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
<?php if(isset($classrooms) && !empty($classrooms)): ?>
<?php echo $this->Html->script(array('admin/grid'), array('inline'=> false))?>
<div id="classroomGrid" class="span12">
	<?php echo $this->element('backend/classroom_grid', compact('classrooms'))?>
</div>
<script type="text/javascript">
	$('#classroomGrid').owsGrid({
		url: '<?php echo $this->Html->url(array('controller'=> 'classrooms', 'action'=> 'grid')); ?>',
		exportUrl: '<?php echo $this->Html->url(array('controller'=> 'users', 'action'=> 'export')); ?>',
		actions: {
			'delete': {'id': 'btn_delete', 'confirm': '<?php echo __('Are you sure you want to delete ?') ?>'}
		},
		pageVar: 'page',
		sortVar: 'sort',
		dirVar: 'direction',
		filterVar: 'classroom_filter',
		formFieldNameInternal: 'classroom',
		gridIds: '<?php echo implode("," ,$classroomIds) ?>'
	});
	var classroomGrid = $('#classroomGrid').data('owsGrid');
</script>
<?php else: ?>
<div class="alert">
  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No classroom in system.')?>
</div>
<?php endif ?>

</div>

