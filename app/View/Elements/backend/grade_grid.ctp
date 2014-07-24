<?php echo $this->Form->create('Grade', array('inputDefaults'=> array('div'=> false, 'label'=> false))) ?>
<?php echo $this->element('backend/grid_bar', array('jsObject'=> 'gradeGrid'))?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10">#</th>
			<th width="10">&nbsp;</th>
			<th><?php echo __('Name') ?></th>
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
		<?php foreach($grades as $k => $grade): ?>
		<tr>
			<td width="10" class="center"><?php echo $startPosition + $k + 1 ?></td>
			<td width="10" class="center"><?php echo $this->Form->checkbox('rowcheckbox', array('class'=> 'row-checkbox', 'value'=> $grade['Grade']['id']))?></td>
			<td><?php echo $this->Html->link($grade['Grade']['name'], array('controller'=> 'grades', 'action'=> 'edit', $grade['Grade']['id'])) ?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Form->end() ?>
