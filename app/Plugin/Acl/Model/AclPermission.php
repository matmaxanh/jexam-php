<?php
/**
 * AclPermission Model
 *
 */
class AclPermission extends AppModel {

/**
 * name
 *
 * @var string
 */
	public $name = 'AclPermission';

/**
 * useTable
 *
 * @var string
 */
	public $useTable = 'aros_acos';

/**
 * belongsTo
 *
 * @var array
 */
	public $belongsTo = array(
		'AclAro' => array(
			'className' => 'Acl.AclAro',
			'foreignKey' => 'aro_id',
		),
		'AclAco' => array(
			'className' => 'Acl.AclAco',
			'foreignKey' => 'aco_id',
		),
	);

/**
 * Generate allowed actions for current logged in Role
 *
 * @param integer $roleId
 * @return array of elements formatted like ControllerName/action_name
 */
	public function getAllowedActionsByRoleId($roleId) {
		$acosTree = $this->AclAco->generateTreeList(array(
			'AclAco.parent_id !=' => null,
		), '{n}.AclAco.id', '{n}.AclAco.alias');
		$acos = array();
		$controller = null;
		foreach ($acosTree as $acoId => $acoAlias) {
			if (substr($acoAlias, 0, 1) == '_') {
				$acos[$acoId] = $controller . '/' . substr($acoAlias, 1);
			} else {
				$acos[$acoId] = $acoAlias;
				$controller = $acoAlias;
			}
		}
		$acoIds = array_keys($acos);
		
		$aro = $this->AclAro->find('first', array(
			'conditions' => array(
				'AclAro.model' => 'Role',
				'AclAro.foreign_key' => $roleId,
			),
		));
		$aroId = $aro['AclAro']['id'];

		$permissionsForCurrentRole = $this->find('all', array(
			'conditions' => array('AclPermission.aro_id' => $aroId, 'AclPermission.aco_id' => $acoIds),
		));
		
		$allowActions = $denyActions = array();
		foreach ($permissionsForCurrentRole as $permission) {
			if(($permission['AclPermission']['_create'] == 1)){
				if(($permission['AclAco']['parent_id'] != null) && ($permission['AclAco']['parent_id'] != 1)){
					$allowActions[] = $acos[$permission['AclAco']['id']];
				}else{
					$actions = $this->AclAco->find('list', array(
						'fields'=> array('AclAco.id', 'AclAco.id'),
						'conditions'=> array('parent_id' => $permission['AclAco']['id']),
					));
					foreach($actions as $acoId){
						$allowActions[] = $acos[$acoId];
					}
				}
			}
			
			if(($permission['AclPermission']['_create'] == -1)){
				if(($permission['AclAco']['parent_id'] != null) && ($permission['AclAco']['parent_id'] != 1)){
					$denyActions[] = $acos[$permission['AclAco']['id']];
				}else{
					$actions = $this->AclAco->find('list', array(
						'fields'=> array('AclAco.id', 'AclAco.alias'),
						'conditions'=> array('parent_id' => $permission['AclAco']['parent_id']),
					));
					foreach($actions as $acoId){
						$denyActions[] = $acos[$acoId];
					}
				}
			}
		}
		array_unique($allowActions);
		array_unique($denyActions);
		return array_diff($allowActions, $denyActions);
	}

}
