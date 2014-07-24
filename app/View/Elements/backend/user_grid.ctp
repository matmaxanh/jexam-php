<?php echo $this->Form->create('User', array('inputDefaults'=> array('div'=> false, 'label'=> false))) ?>
<?php echo $this->element('backend/grid_bar', array('jsObject'=> 'userGrid'))?>
<?php $statusOption = Configure::read('Constant.status') ?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10">#</th>
			<th width="8">&nbsp;</th>
			<th><?php echo __('Username') ?></th>
			<th><?php echo __('Email') ?></th>
			<th><?php echo __('Role') ?></th>
			<th><?php echo __('Create Date') ?></th>
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
		<?php foreach($users as $k => $user): ?>
		<tr>
			<td class="center"><?php echo $startPosition + $k + 1 ?></td>
			<td class="center"><?php echo $this->Form->checkbox('rowcheckbox', array('class'=> 'row-checkbox', 'value'=> $user['User']['id']))?></td>
			<td><?php echo $this->Html->link($user['User']['username'], array('controller'=> 'users', 'action'=> 'edit', $user['User']['id'])) ?></td>
			<td><?php echo $user['User']['email'] ?></td>
			<td><?php echo $user['Role']['name'] ?></td>
			<td><?php echo date(Configure::read('Setting.datetime_format'), strtotime($user['User']['created'])) ?></td>
			<td><?php if(isset($statusOption[$user['User']['status']])) echo $statusOption[$user['User']['status']] ?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Form->end() ?>
