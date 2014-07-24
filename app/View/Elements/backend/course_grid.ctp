<?php echo $this->Form->create('Course', array('inputDefaults'=> array('div'=> false, 'label'=> false))) ?>
<?php echo $this->element('backend/grid_bar', array('jsObject'=> 'CourseGrid'))?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10">#</th>
			<th width="10">&nbsp;</th>
			<th><?php echo __('Name') ?></th>
			<th><?php echo __('Year') ?></th>
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
		<?php foreach($courses as $k => $course): ?>
		<tr>
			<td width="10" class="center"><?php echo $startPosition + $k + 1 ?></td>
			<td width="10" class="center"><?php echo $this->Form->checkbox('rowcheckbox', array('class'=> 'row-checkbox', 'value'=> $course['Course']['id']))?></td>
			<td><?php echo $this->Html->link($course['Course']['name'], array('controller'=> 'courses', 'action'=> 'edit', $course['Course']['id'])) ?></td>
			<td><?php echo $course['Course']['year_from'].' - '.$course['Course']['year_to']; ?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Form->end() ?>
