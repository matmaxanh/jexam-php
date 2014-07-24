<?php
/**
 * Acl Helper
 *
 */
class AclHelper extends Helper {

	/**
	 * Other helpers used by this helper
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = array('Session');

	/**
	 * Cached actions per Role
	 *
	 * @var array
	 * @access public
	 */
	public $allowedActions = array();

	/** Generate allowed actions for current logged in Role
	 *
	 * @return array
	 */
	public function getAllowedActions($roleId) {
		if (!empty($this->allowedActions[$roleId])) {
			return $this->allowedActions[$roleId];
		}
		
		if($this->Session->check('Auth.User.Permission')){
			$this->allowedActions[$roleId] = $this->Session->read('Auth.User.Permission');
		}else{
			$this->allowedActions[$roleId] = ClassRegistry::init('Acl.AclPermission')->getAllowedActionsByRoleId($roleId);
		}
		return $this->allowedActions[$roleId];
	}

	/**
	 * Check if url is allowed for the Role
	 *
	 * @return boolean
	 */
	public function linkIsAllowedByRoleId($roleId, $url) {
		if(!empty($this->request->params['prefix'])){
			$url['prefix'] = $this->request->params['prefix'];
		}
		if(isset($url['prefix'])){
			$linkAction = Inflector::camelize($url['controller']) . '/' . $url['prefix']. '_' . $url['action'];
		}else{
			$linkAction = Inflector::camelize($url['controller']) . '/' . $url['action'];
		}
		if (in_array($linkAction, $this->getAllowedActions($roleId))) {
			return true;
		}
		return false;
	}

}
