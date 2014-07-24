<?php
$this->start('box-header');
echo '<h2><i class="icon-list-alt"></i><span class="break"></span>'.__('Exams').'</h2>';
$this->end(); 
$this->start('toolbar'); 
echo $this->Html->link(
	'<i class="icon-plus icon-white"></i>&nbsp;'.__('Add new exam'),
	array('controller'=> 'exams', 'action'=> 'add'),
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
	<?php if(!empty($exams)): ?>
	<?php $statusOption = Configure::read('Constant.status')?>
	<?php echo $this->Html->script(array('admin/grid'), array('inline'=> false))?>
	<div id="examGrid" class="span12">
		<?php echo $this->element('backend/exam_grid', compact('exams'))?>
	</div>
	<script type="text/javascript">
		$('#examGrid').owsGrid({
			url: '<?php echo $this->Html->url(array('controller'=> 'exams', 'action'=> 'grid')); ?>',
			exportUrl: '<?php echo $this->Html->url(array('controller'=> 'exams', 'action'=> 'export')); ?>',
			actions: {
				'delete': {'id': 'btn_delete', 'confirm': '<?php echo __('Are you sure you want to delete ?') ?>'}
			},
			pageVar: 'page',
			sortVar: 'sort',
			dirVar: 'direction',
			filterVar: 'exam_filter',
			formFieldNameInternal: 'exam',
			gridIds: '<?php echo implode("," ,$examIds) ?>'
		});
		var examGrid = $('#examGrid').data('owsGrid');
	</script>
	<?php else: ?>
	<div class="alert">
	  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No exam in system.')?>
	</div>
	<?php endif ?>
</div>



