<?php

App::uses('AppModel', 'Model');
App::uses('Security', 'Utility');

/**
 * User Model
 *
 */
class User extends AppModel {

    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false), 'Containable');
    public $belongsTo = array('Role');
    public $ignoresync = true;
    public $hasMany = array(
	  'UserCategory' => array(
		'className' => 'UserCategory',
		'foreignKey' => 'user_id',
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
    var $validate = array(
	  'fullname' => array(
		'rule' => 'notEmpty',
	  ),
	  'username' => array(
// 			'username_must_not_be_empty'=> array(
// 				'rule' => 'notEmpty',
// 	            'last' => true,
// 			),
		'username_must_be_unique' => array(
		    'rule' => 'isUnique',
		    'last' => true,
		),
	  ),
	  'email' => array(
// 			'email_must_not_be_empty' => array(
// 				'rule' => 'notEmpty',
// 	            'last' => true,
// 			),
		'email_form' => array(
		    'rule' => 'email',
		    'last' => true,
		),
		'email_must_be_unique' => array(
		    'rule' => 'isUnique',
		    'last' => true,
		),
	  ),
	  'passwd' => array(
// 			'required' => array(
// 				'rule' => 'notEmpty',
// 			),
		'min' => array(
		    'rule' => array('minLength', 6),
		),
		'match' => array(
		    'rule' => 'validatePasswdConfirm',
		)
	  ),
	  'passwd_confirm' => array(
		'required' => array(
		    'rule' => 'notEmpty',
		),
	  ),
    );

    public function validatePasswdConfirm($params, $opt) {
	  $assoc = each($params);
	  if ($this->data['User'][$assoc['key']] === $this->data['User'][$assoc['key'] . '_confirm']) {
		return true;
	  }
	  return false;
    }

    public function beforeSave($options = array()) {
	  if (isset($this->data['User']['passwd']) && !empty($this->data['User']['passwd'])) {
		$this->data['User']['password'] = Security::hash($this->data['User']['passwd'], null, true);
		unset($this->data['User']['passwd']);
	  }

	  if (isset($this->data['User']['passwd_confirm'])) {
		unset($this->data['User']['passwd_confirm']);
	  }

	  return true;
    }

    public function parentNode() {
	  if (!$this->id && empty($this->data)) {
		return null;
	  }
	  if (isset($this->data['User']['role_id'])) {
		$roleId = $this->data['User']['role_id'];
	  } else {
		$roleId = $this->field('role_id');
	  }
	  if (!$roleId) {
		return null;
	  } else {
		return array('Role' => array('id' => $roleId));
	  }
    }

    public function bindNode($user) {
	  return array('model' => 'Role', 'foreign_key' => $user['User']['role_id']);
    }

    /*
     * when create exam, generate random password for each class
     */

    function generateRandomPassword($classId, $length = 6) {
	  $characters = '0123456789';
	  $password = '';
	  for ($i = 0; $i < $length; $i++) {
		$password .= $characters[rand(0, strlen($characters) - 1)];
	  }
	  
	  $hash = Security::hash($password, null, true);
	  $db = $this->getDataSource();
	  $hash = $db->value($hash, 'string');
	  
	  $this->updateAll(
		array('User.password' => $hash),
		array('User.class_id' => $classId, 'User.role_id' => 4)
	  );
	  return $password;
    }

}
