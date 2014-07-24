<?php
/**
 * AclFilter Component
 *
 */
class AclFilterComponent extends Component {

/**
 * _controller
 *
 * @var Controller
 */
	protected $_controller = null;

/**
 * @param object $controller controller
 * @param array  $settings   settings
 */
	public function initialize(Controller $controller) {
		$this->_controller =& $controller;
	}

/**
 * acl and auth
 *
 * @return void
 */
	public function auth() {
		//Configure AuthComponent
		$this->_controller->Auth->authenticate = array(
			AuthComponent::ALL => array(
				'userModel' => 'User',
				'fields' => array(
					'username' => 'username',
					'password' => 'password',
				),
				'scope' => array(
					'User.status' => STATUS_ACTIVE,
				),
			),
			'Form',
		);
		$actionPath = 'controllers';
		$this->_controller->Auth->authorize = array(
			AuthComponent::ALL => array('actionPath' => $actionPath),
			'Actions',
		);
		$this->_controller->Auth->sessionKey = 'Auth.User';
		$this->_controller->Auth->loginAction = array(
			'plugin' => null,
			'controller' => 'users',
			'action' => 'login',
		);
		$this->_controller->Auth->logoutRedirect = array(
			'plugin' => null,
			'controller' => 'users',
			'action' => 'login',
		);
		$this->_controller->Auth->loginRedirect = array(
			'plugin' => null,
			'controller' => 'users',
			'action' => 'dashboard',
		);
		if ($this->_controller->Auth->user() && $this->_controller->Auth->user('role_id') === ROLE_ID_SUPERADMIN) {
			// Role: Admin
			$this->_controller->Auth->allow();
		} else {
			if ($this->_controller->Auth->user()) {
				$roleId = $this->_controller->Auth->user('role_id');
			} else {
				$roleId = 1; // Role: Public
			}

			if($this->_controller->Session->check($this->_controller->Auth->sessionKey .'.Permission')){
				$allowedActions = $this->_controller->Session->read($this->_controller->Auth->sessionKey .'.Permission');
			}else{
				$allowedActions = ClassRegistry::init('Acl.AclPermission')->getAllowedActionsByRoleId($roleId);
			}
			$linkAction = Inflector::camelize($this->_controller->request->params['controller']) . '/' . $this->_controller->request->params['action'];
			if (in_array($linkAction, $allowedActions)) {
				$this->_controller->Auth->allowedActions = array($this->_controller->request->params['action']);
			}
		}
	}

}
