<?php
$this->start('toolbar');
echo $this->Layout->renderLink(
	'<i class="icon-plus icon-white"></i>&nbsp;'.__('Add question'),
	array('controller'=> 'questions', 'action'=> 'add'),
	array('class'=> 'btn btn-small btn-success', 'id'=> 'btnAddQuestion')
);
echo $this->Layout->renderLink(
	'<i class="icon-remove"></i>&nbsp;'.__('Delete'),
	array('controller'=> 'questions', 'action'=> 'delete'),
	array('id'=> 'btn_delete', 'onclick'=> 'return false')
);
$this->end();
?>
<div class="row-fluid">
<?php if(!empty($questions)): ?>
<?php echo $this->Html->script(array('admin/grid'), array('inline'=> false))?>
<div id="questionGrid" class="span12">
	<?php echo $this->element('backend/question_grid', compact('questions', 'displayAuthor', 'displayAnswer'))?>
</div>
<script type="text/javascript">
	$('#questionGrid').owsGrid({
		url: '<?php echo $this->Html->url(array('controller'=> 'questions', 'action'=> 'grid')); ?>',
		exportUrl: '<?php echo $this->Html->url(array('controller'=> 'questions', 'action'=> 'export')); ?>',
		actions: {
			'delete': {'id': 'btn_delete', 'confirm': '<?php echo __('Are you sure you want to delete ?') ?>'}
		},
		pageVar: 'page',
		sortVar: 'sort',
		dirVar: 'direction',
		filterVar: 'question_filter',
		formFieldNameInternal: 'question',
	});
	var questionGrid = $('#questionGrid').data('owsGrid');
</script>
<?php else: ?>
	<div class="alert">
	  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No question in system.')?>
	</div>
<?php endif ?>


<!-- Modal -->
<div id="modalArea">
	<div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="width:800px;margin-left:-400px">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h5 id="modalLabel"><?php echo __('Select a question format')?></h5>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
	            <ul class="thumbnails">
	            	<?php foreach($questionTypes as $questionTypeId => $questionTypeName): ?>
					<li class="span3">
						<div class="thumbnail thumbnail-qtype" data-question-type="<?php echo $questionTypeId ?>">
							<img src="http://placehold.it/300x200/999999/ffffff" alt="<?php echo $questionTypeName ?>" title="<?php echo $questionTypeName ?>">
							<label class="center" style="font-size: 13px;"><?php echo $questionTypeName ?></label>
						</div>
					</li>
					<?php endforeach; ?>
	            </ul>
	          </div>
		</div>
	</div>
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#btnAddQuestion").click(function(){
		$("#modal").modal('show');
		return false;
	});
	$("#modal .thumbnails .thumbnail").click(function(){
		var qtid = $(this).attr('data-question-type');
		location.href = '<?php echo $this->Html->url(array('controller'=> 'questions', 'action'=> 'add')) ?>' + '/' + qtid;
	});
});
</script>
