<?php
	if ($success == 1) {
		if ($permitted == 1) {
			echo $this->Html->image('/img/icons/tick.png', array('class' => 'permission-toggle', 'data-aco-id' => $acoId, 'data-aro-id' => $aroId));
		} else {
			echo $this->Html->image('/img/icons/cross.png', array('class' => 'permission-toggle', 'data-aco-id' => $acoId, 'data-aro-id' => $aroId));
		}
	} else {
		__('error');
	}
?>