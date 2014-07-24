<?php if(!is_null($questionTypeId)): ?>
<?php $this->start('toolbar');?>
<div class="btn-group" id="toolbar-apply">
	<button onclick="OWS.submitbutton('save')" class="btn btn-small btn-success">
		<i class="icon-ok icon-white"></i> <?php echo __('Save')?>
	</button>
</div>

<div class="btn-group" id="toolbar-save">
	<button onclick="OWS.submitbutton('save2new')" class="btn btn-small btn-info">
		<i class="icon-plus"></i> <?php echo __('Save & New')?>
	</button>
</div>

<div class="btn-group" id="toolbar-cancel">
	<button onclick="OWS.submitbutton('cancel')" class="btn btn-small">
		<i class="icon-remove"></i> <?php echo __('Cancel')?>
	</button>
</div>
<div class="btn-group divider"></div>
<?php $this->end() ?>
<?php echo $this->element('question_form', compact('questionTypeId'))?>
<script type="text/javascript">
OWS.submitbutton = function(task) {
	if(task == 'cancel'){
		location.href = '<?php echo $this->Html->url(array('controller'=> 'questions', 'action'=> 'index')) ?>';
	}else{
		$("#question_form #answer").val(owsAnswer.getAnswerData());
		OWS.submitform(task, document.getElementById('question_form'));
	}
};
</script>
<?php endif; ?>



