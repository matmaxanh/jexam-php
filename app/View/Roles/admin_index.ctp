<?php
$this->start('box-header');
echo '<h2><i class="icon-list-alt"></i><span class="break"></span>'.__('Role').'</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link('<i class="icon-plus icon-white"></i>&nbsp;'.__('Add new role'),
	array('controller'=> 'roles', 'action'=> 'add'),
	array('escape'=> false, 'class'=> 'btn btn-small btn-success'));
$this->end();
?>

<div class="tests index">
<?php if(!empty($roles)): ?>
<?php echo $this->Form->create('Role') ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="1%"></th>
			<th><?php echo __('Role title') ?></th>
			<th width="20%"><?php echo __('Parent ID') ?></th>
			<th width="5%"><?php echo __('ID') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($roles as $k => $role): ?>
		<tr>
			<td><?php echo $this->Form->checkbox('cid[]', array('id'=> 'cb'.$k, 'value'=> $role['Role']['id'], 
			'onclick' => 'OWS.isChecked(this.checked);', 'title'=> __(sprintf('Checkbox for row %s', ++$k)))) ?></td>
			<td><?php echo $this->Html->link($role['Role']['name'], array('controller'=> 'roles', 'action'=> 'edit', $role['Role']['id'])) ?></td>
			<td><?php echo $role['Role']['parent_id'] ?></td>
			<td><?php echo $role['Role']['id'] ?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Form->end() ?>
<?php else: ?>
<div class="alert">
  <?php echo '<h4>'.__('Warning').'!</h4>'.__('No roles in system.')?>
</div>
<?php endif ?>
</div>
