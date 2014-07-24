<?php
App::uses('AppModel', 'Model');
/**
 * Role Model
 *
 * @property Role $ParentRole
 * @property Role $ChildRole
 * @property User $User
 */
class Role extends AppModel {

	public $actsAs = array('Tree', 'Acl'=> array('type'=> 'requester'));

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $ignoresync = true;


//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentRole' => array(
			'className' => 'Role',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildRole' => array(
			'className' => 'Role',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'role_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	public function parentNode(){
		return null;
	}
	
}
