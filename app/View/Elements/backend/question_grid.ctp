<?php if(!isset($displayFilter) || $displayFilter): ?>
<?php echo $this->Form->create('Question', array('inputDefaults'=> array('div'=> false, 'label'=> false))) ?>
<?php echo $this->element('backend/grid_bar', array('jsObject'=> 'questionGrid'))?>
<?php endif ?>
<div class="questions index">
	<?php $questionStatus = Configure::read('Constant.status_question'); ?>
	<table class="grid table table-striped table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th><input type="checkbox" name="all" /></th>
				<th><?php echo __('Question') ?></th>
				<?php if($displayAuthor): ?>
				<th><?php echo __('Author') ?></th>
				<?php endif; ?>
				<th width="100"><?php echo __('Subject')?></th>
				<th width="100"><?php echo __('Type') ?></th>
				<th><?php echo __('Difficulty') ?></th>
				<th width="100"><?php echo __('Create Date') ?></th>
				<th width="100"><?php echo __('Last Update') ?></th>
				<th><?php echo __('Score') ?></th>
				<th><?php echo __('Status') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $paging = $this->Paginator->params();
			if(isset($paging['page']) && isset($paging['limit'])){
				$startPosition = ($paging['page']-1) * $paging['limit'];
			}else{
				$startPosition = 0;
			}
			?>
			<?php foreach($questions as $k => $question): ?>
			<tr>
				<td><?php echo $startPosition + $k + 1 ?></td>
				<td><?php echo $this->Form->checkbox('qbox', array('class'=> 'row-checkbox', 'value'=> $question['Question']['id']))?></td>
				<td>
					<?php echo $this->Html->link(String::truncate(strip_tags($question['Question']['content'])), array('controller'=> 'questions', 'action'=> 'edit', $question['Question']['id']), array('escape'=> false)) ?>
					<?php if($displayAnswer){
						$answerData = json_decode($question['Question']['answer'],true);
						$answers = array();
						foreach($answerData as $answer){
							if($answer['correctAnswer']){
								$answers[] = '<i class="icon-ok"></i>&nbsp;'.$answer['value'];
							}else{
								$answers[] = '<i class="icon-remove"></i>&nbsp;'.$answer['value'];
							}
						}
						echo $this->Html->nestedList($answers, array('class'=> 'unstyled'));
					}?>
				</td>
				<?php if($displayAuthor): ?>
				<td><?php echo $question['Author']['username'] ?></td>
				<?php endif; ?>
				<td><?php echo $question['Subject']['name'] ?></td>
				<td><?php echo __($question['QuestionType']['name']) ?></td>
				<td><?php echo $question['Question']['difficulty'] ?></td>
				<td><?php echo date(Configure::read('Setting.date_format'), strtotime($question['Question']['created'])) ?></td>
				<td><?php echo date(Configure::read('Setting.date_format'), strtotime($question['Question']['updated'])) ?></td>
				<td><?php echo $question['Question']['score'] ?></td>
				<td><?php if(isset($questionStatus[$question['Question']['status']])) echo $questionStatus[$question['Question']['status']] ?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>
<?php if(!isset($displayFilter) || $displayFilter): ?>
<?php echo $this->Form->end() ?>
<?php endif ?>
