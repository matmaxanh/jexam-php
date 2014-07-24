<?php 
$this->start('box-header');
echo '<h2><i class="icon-th-large"></i><span class="break"></span>'.__('Subject').'</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link('<i class="icon-plus icon-white"></i>&nbsp'.__('Add new subject'),
	array('controller'=> 'subjects', 'action'=> 'add'),
	array('escape'=> false, 'class'=> 'btn btn-small btn-success')
);
echo $this->Layout->renderLink(
	'<i class="icon-remove"></i>&nbsp;'.__('Delete'),
	'javascript:;',
	array('id'=> 'btn_delete', 'class'=> 'btn btn-small btn-danger')
);
$this->end();
?>
<div class="row-fluid">
	<?php if(!empty($subjects)): ?>
	<?php echo $this->Html->script(array('admin/grid'), array('inline'=> false))?>
	<div id="subjectGrid" class="span12">
		<?php echo $this->element('backend/subject_grid', compact('subjects'))?>
	</div>
	<script type="text/javascript">
		$('#subjectGrid').owsGrid({
			url: '<?php echo $this->Html->url(array('controller'=> 'subjects', 'action'=> 'grid')); ?>',
			exportUrl: '<?php echo $this->Html->url(array('controller'=> 'subjects', 'action'=> 'export')); ?>',
			actions: {
				'delete': {'id': 'btn_delete', 'confirm': '<?php echo __('Are you sure you want to delete ?') ?>'}
			},
			pageVar: 'page',
			sortVar: 'sort',
			dirVar: 'direction',
			filterVar: 'subject_filter',
			formFieldNameInternal: 'subject',
			gridIds: '<?php echo implode("," ,$subjectIds) ?>'
		});
		var subjectGrid = $('#subjectGrid').data('owsGrid');
	</script>
	<?php else: ?>
	<div class="alert">
	  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No subject in system.')?>
	</div>
	<?php endif ?>
</div>