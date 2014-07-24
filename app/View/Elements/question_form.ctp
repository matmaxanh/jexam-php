<?php echo $this->Html->script(array('answer', 'select2.min', 'ckeditor/ckeditor'), array('inline' => false))?>
<?php echo $this->Html->css(array('select2/select2'), null, array('inline' => false))?>
<div class="container-main">
	<?php echo $this->Form->create('Question', array('id'=> 'question_form', 'inputDefaults'=> array('label'=> false, 'div'=> false, 'error'=> false))); ?>
	<div class="row-fluid">
		<!-- Begin Content -->
		<div class="span9">
		<?php
		echo $this->Form->hidden('id');
		echo $this->Form->hidden('question_type_id', array('value'=> $questionTypeId));
		echo $this->Form->hidden('task', array('id'=> 'task'));
		echo $this->Form->hidden('answer', array('id'=> 'answer'));
		echo $this->Form->textarea('content', array('class'=> 'ckeditor', 'id'=> 'question_content', 'rows'=> 11, 'style'=> 'width: 100%;max-width: 100%;'), array(), 'full');
		?>
		<div class="clearfix" id="answer_wrap"></div>
		</div>
		<!-- End Content -->
		<!-- Begin Sidebar -->
		<div class="span3">
			<div class="row-fluid">
                <div class="control-group">
					<?php echo __('Subject'); ?>
					<div class="controls">
						<?php echo $this->Form->select('subject_id', $subjects, array('class'=> 'span12 input-select2', 'empty'=> false)); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo __('Score'); ?>
					<div class="controls">
						<?php echo $this->Form->input('score', array('min'=> MIN_SCORE, 'value'=> MIN_SCORE, 'class'=> 'span12', 'id'=> 'question_score')); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo __('Difficulty'); ?>
					<div class="controls"><?php
					$difficulties = Configure::read('Constant.question_difficult');
					echo $this->Form->select('difficulty', $difficulties, array('value' => 2, 'class'=> 'span12 input-select2', 'id'=> 'question_difficulty', 'empty'=> false));
					?></div>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
	</div>
	<?php echo $this->Form->end(); ?>
	
</div>
<script type="text/javascript">
$("#answer_wrap").owsAnswer({
	formId: 'question_form',
	type: <?php echo $questionTypeId ?>,
	choices: <?php echo isset($this->data['Question']['answer'])?$this->data['Question']['answer']:'[]' ?>,
	placeholderText : '<?php echo __('enter answer text') ?>',
	minAnswerNumber: <?php echo MIN_ANSWER_NUMBER ?>
});
var owsAnswer = $('#answer_wrap').data('owsAnswer');
$(".input-select2").select2();
</script>
