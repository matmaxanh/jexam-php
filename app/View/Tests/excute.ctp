<?php if(isset($test) && isset($question)): ?>
<div class="row-fluid test-answer">
	<div class="span8 offset2">
		<h2><?php echo __('Test : ').h($test['Exam']['name']) ?></h2>
		<div class="time-wrap"><?php echo __('Time Remaining:') ?>&nbsp;<span id="timertext"></span></div>
		<div class="well well-small">
			<b><?php echo __('Question %d of %d', $question['order_number'], $test['Exam']['question_number']) ?>
		</div>
		<div class="question-form-head">
			<?php echo $question['content']; ?>
		</div>
		<hr>

		<?php echo $this->Form->create('Test', array('url'=> '/testing', 'id' => 'questionForm', 'class' => 'question-form')); ?>
		
		<div class="question-form-body">
		<?php
		echo $this->Form->input('answer', array('type'=> $question['input_type'], 'options'=> $question['answers'], 'legend'=> false, 'label' => array('class' => 'answer-wrap')));
		?>
		</div>
		
		<div class="row-fluid question-form-footer">
			<div class="span4"></div>
			<div class="span4 center"><?php echo $this->Form->button('<i class="icon-circle-arrow-right icon-white"></i>&nbsp;'.__('Next'), 
					array('class'=> 'btn btn-primary', 'onclick' => "return OWS.checkSelectAnswer('questionForm')")); ?></div>
			<div class="span4"><?php echo $this->Html->link(__('Report an issue with this question'), '#feedback', array('data-toggle' => 'modal'))?></div>
		</div>
		
		<?php echo $this->Form->hidden('qid', array('value'=> $question['id'])); ?>
		<?php echo $this->Form->end(); ?>
		
		<?php endif; ?>
	</div>
</div>
<!--<div id="feedback" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">×</button>
		<h3 id="myModalLabel">Modal header</h3>
	</div>
	<div class="modal-body">
		<p>One fine body…</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary">Save changes</button>
	</div>
</div>-->

<script type="text/javascript">
$(document).ready(function () {
	var timer = <?php echo ($test['Test']['end_time'] - time()) ?>,
		counter = setInterval(countdown, 1000); // run it every 1 second
	function countdown(){
		timer = timer - 1;
		if (timer <= 0){
			$("#timertext").html("0:00");
			clearInterval(counter);
			//counter ended, do something here
			return;
		}

	 	if(timer <= 10){
        	$('#timertext').css('color', 'red');
        }
        
		$("#timertext").html(OWS.displayTime(timer));
	}
	$("#feedback").modal('hide');
});
</script>

