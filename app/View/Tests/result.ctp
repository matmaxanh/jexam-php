<?php 
if(isset($test)):
    if($test['Test']['is_passed']){
	  $result = __('passed');
	  $filename = 'glad.png';
    }else{
	  $result = __('failed');
	  $filename = 'sad.png';
    }
?>
<div class="row test-result">
	<div class="span8 offset2">
		<p class="lead">
			<?php echo __('Test Results: ').h($test['Exam']['name']) ?>
		</p>
		<hr>
		<div class="row-fluid">
			<div class="span3 center"><?php echo $this->Html->image($filename) ?></div>
			<div class="span9">
				<table class="row-fluid information" border="0">
					<tr>
						<td class="span6"><strong><?php echo __('Your Score').' : ' ?></strong></td>
						<td class="span6"><strong><?php echo $test['Test']['score'] ?></strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Result').' : ' ?></strong></td>
						<td><strong><?php echo $result ?></strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Passing Score').' : ' ?></strong></td>
						<td><strong><?php echo $test['Exam']['pass_score'] ?></strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Done Question Number').' : ' ?></strong></td>
						<td><strong><?php echo $test['Test']['done_question_number'] ?></strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Date : ') ?></strong></td>
						<td><?php echo date('d/m/Y', strtotime($test['Test']['created'])) ?></td>
					</tr>
				</table>
			</div>
		</div>
		<hr>
		<div class="center">
			<?php echo $this->Html->link('<i class="icon icon-arrow-right icon-white"></i>&nbsp;'.__('Continue'), array('controller' => 'tests', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-success'))?>
		</div>
		</div>
	</div>
</div>
<?php endif; ?>