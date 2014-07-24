<?php
$this->start('box-header');
echo '<h2><i class="icon-list-alt"></i><span class="break"></span>'.__('Grade').'</h2>';
$this->end(); 
$this->start('toolbar');
echo $this->Layout->renderLink(
	'<i class="icon-plus icon-white"></i>&nbsp;'.__('Add new grade'),
	array('controller'=> 'grades', 'action'=> 'add'),
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
<?php if(isset($grades) && !empty($grades)): ?>
<?php echo $this->Html->script(array('admin/grid'), array('inline'=> false))?>
<div id="gradeGrid" class="span12">
	<?php echo $this->element('backend/grade_grid', compact('grades'))?>
</div>
<script type="text/javascript">
	$('#gradeGrid').owsGrid({
		url: '<?php echo $this->Html->url(array('controller'=> 'grades', 'action'=> 'grid')); ?>',
		exportUrl: '<?php echo $this->Html->url(array('controller'=> 'users', 'action'=> 'export')); ?>',
		actions: {
			'delete': {'id': 'btn_delete', 'confirm': '<?php echo __('Are you sure you want to delete ?') ?>'}
		},
		pageVar: 'page',
		sortVar: 'sort',
		dirVar: 'direction',
		filterVar: 'grade_filter',
		formFieldNameInternal: 'grade',
		gridIds: '<?php echo implode("," ,$gradeIds) ?>'
	});
	var gradeGrid = $('#gradeGrid').data('owsGrid');
</script>
<?php else: ?>
<div class="alert">
  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No grade in system.')?>
</div>
<?php endif ?>

</div>

