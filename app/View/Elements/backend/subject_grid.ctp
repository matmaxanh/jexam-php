<?php
$statusOption = Configure::read('Constant.status');
$datetimeFormat = Configure::read('Setting.datetime_format');
echo $this->Form->create('Question', array('inputDefaults'=> array('div'=> false, 'label'=> false)));
echo $this->element('backend/grid_bar', array('jsObject'=> 'subjectGrid'));
?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10">&nbsp;</th>
			<th width="5">&nbsp;</th>
			<th><?php echo __('Subject') ?></th>
            <th><?php echo __('Group Subject') ?></th>
			<th width="20%"><?php echo __('Status') ?></th>
			<th width="20%"><?php echo __('Create Date') ?></th>
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
		<?php foreach($subjects as $k => $subject): ?>
		<tr>
			<td width="20" class="center"><?php echo $startPosition + $k + 1 ?></td>
			<td width="20" class="center"><?php echo $this->Form->checkbox('rowcheckbox', array('class'=> 'row-checkbox', 'value'=> $subject['Subject']['id']))?></td>
			<td><?php echo $this->Html->link($subject['Subject']['name'], array('controller'=> 'subjects', 'action'=> 'edit', $subject['Subject']['id'])) ?></td>
            <td><?php echo $this->Html->link($subject['ParentSubject']['name'], array('controller'=> 'subjects', 'action'=> 'edit', $subject['ParentSubject']['id'])) ?></td>
			<td><?php if(isset($statusOption[$subject['Subject']['status']])) echo $statusOption[$subject['Subject']['status']] ?></td>
			<td><?php echo date($datetimeFormat, strtotime($subject['Subject']['created'])) ?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Form->end() ?>