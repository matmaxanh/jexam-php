<?php
$datetimeFormat = Configure::read('Setting.datetime_format');
$statusOption = Configure::read('Constant.status_exam');
echo $this->Form->create('Exam', array('inputDefaults' => array('div' => false, 'label' => false)));
echo $this->element('backend/grid_bar', array('jsObject' => 'examGrid'));
?>
<table class="table table-bordered table-stripped">
    <thead>
	  <tr>
		<th width="10">&nbsp;</th>
            <th width="5">&nbsp;</th>
		<th><?php echo __('Name') ?></th>
		<th width="20%"><?php echo __('Subject') ?></th>
		<th width="110"><?php echo __('Question No') ?></th>
		<th width="20%"><?php echo __('Status') ?></th>
		<th width="20%"><?php echo __('Create Date') ?></th>
	  </tr>
    </thead>
    <tbody>
	  <?php
	  $paging = $this->Paginator->params();
	  if (isset($paging['page']) && isset($paging['limit'])) {
		$startPosition = ($paging['page'] - 1) * $paging['limit'];
	  } else {
		$startPosition = 0;
	  }
	  foreach ($exams as $k => $exam): 
		if (isset($statusOption[$exam['Exam']['status']])){
		    $status = $statusOption[$exam['Exam']['status']];
		}else{
		    $status = '';
		}
		switch($exam['Exam']['status']){
		    case STATUS_EXAM_ACTIVE:
			  $class = 'info';
			  break;
		    case STATUS_EXAM_COMPLETED:
			  $class = 'success';
			  break;
		    default:
			  $class = 'warning';
		}
	  ?>
	  <tr class="<?php echo $class ?>">
		<td><?php echo $startPosition + $k + 1 ?></td>
		<td width="20" class="center"><?php echo $this->Form->checkbox('rowcheckbox', array('class' => 'row-checkbox', 'value' => $exam['Exam']['id'])) ?></td>
		<td><?php echo $this->Html->link($exam['Exam']['name'], array('controller' => 'exams', 'action' => 'edit', $exam['Exam']['id'])) ?></td>
		<td><?php echo $exam['Subject']['name'] ?></td>
		<td><?php echo $exam['Exam']['question_number'] ?></td>
		<td><?php echo $status ?></td>
		<td><?php echo date($datetimeFormat, strtotime($exam['Exam']['created'])) ?></td>
	  </tr>
	  <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Form->end() ?>