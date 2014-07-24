<?php
$this->Html->script('/acl/js/acl_permissions.js', false);
$this->start('box-header');
echo '<h2><i class="icon-lock"></i><span class="break"></span>'.__('Permission').'</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link('<i class="icon-refresh icon-white"></i>&nbsp;'.__('Generate Action'), array('controller' => 'aclactions', 'action' => 'generate'), array('escape' => false, 'class' => 'btn btn-small btn-primary'));
echo $this->Html->link('<i class="icon-plus icon-white"></i>&nbsp;'.__('Add Action'), array('controller' => 'aclactions', 'action' => 'generate'), array('escape' => false, 'class' => 'btn btn-small btn-success'));
$this->end();
?>
<style type="text/css">
.hidden{
	visibility: visible;
}
</style>


<?php
	echo '<table cellpadding="0" cellspacing="0" class="table" data-base-url="'.$this->Html->url( '/', true ).'">';
	$roleTitles = array_values($roles);
	$roleIds   = array_keys($roles);

	$tableHeaders = array(
		__('Id'),
		__('Alias'),
	);
	$tableHeaders = array_merge($tableHeaders, $roleTitles);
	echo '<thead>'.$this->Html->tableHeaders($tableHeaders).'</thead>';
	echo '<tbody>';
	$currentController = '';
	foreach ($acos AS $id => $alias) {
		$class = '';
		if(substr($alias, 0, 1) == '_') {
			$level = 1;
			$class .= 'level-'.$level;
			$oddOptions = array('class' => 'hidden controller-'.strtolower($currentController));
			$evenOptions = array('class' => 'hidden controller-'.strtolower($currentController));
			$alias = substr_replace($alias, '', 0, 1);
		} else {
			$level = 0;
			$class .= ' controller expand';
			$oddOptions = array();
			$evenOptions = array();
			$currentController = $alias;
		}

		$row = array(
			$id,
			$this->Html->div($class, $alias),
		);

		foreach ($roles AS $roleId => $roleTitle) {
			if ($level != 0) {
				if ($roleId != ROLE_ID_SUPERADMIN) {
					if ($permissions[$id][$roleId] == 1) {
						$row[] = $this->Html->image('/img/icons/tick.png', array('class' => 'permission-toggle', 'data-aco-id' => $id, 'data-aro-id' => $rolesAros[$roleId]));
					} else {
						$row[] = $this->Html->image('/img/icons/cross.png', array('class' => 'permission-toggle', 'data-aco-id' => $id, 'data-aro-id' => $rolesAros[$roleId]));
					}
				} else {
					$row[] = $this->Html->image('/img/icons/tick_disabled.png', array('class' => 'permission-disabled'));
				}
			} else {
				$row[] = '';
			}
		}

		echo $this->Html->tableCells(array($row), $oddOptions, $evenOptions);
	}
	echo '</tbody>';
	echo '</table>';
?>

