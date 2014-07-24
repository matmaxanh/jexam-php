<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Components
     *
     * @var array
     * @access public
     */
    public $components = array(
	  'Security',
	  'Auth',
	  'Session',
	  'Cookie',
	  'Acl',
	  'Acl.AclFilter',
	  'DebugKit.Toolbar',
    );

    /**
     * Helpers
     *
     * @var array
     * @access public
     */
    public $helpers = array(
	  'Session',
	  'Html' => array('className' => 'Bootstrap.BootstrapHtml'),
	  'Form' => array('className' => 'Bootstrap.BootstrapForm'),
	  'Paginator' => array('className' => 'Bootstrap.BootstrapPaginator'),
	  'Layout',
    );

    /**
     * Models
     *
     * @var array
     * @access public
     */
    public $uses = array(
	  'User',
    );

    /**
     * beforeFilter
     *
     * @return void
     */
    public function beforeFilter() {
	  parent::beforeFilter();

	  if (empty($this->AclFilter)) {
		throw new MissingComponentException(array('class' => 'AclFilter'));
	  }
	  
	  
	  $this->Security->blackHoleCallback = 'blackhole';
	  if ($this->request->is('ajax')) {
		$this->Security->csrfCheck = false;
	  }

	  if (isset($this->request->params['admin'])) {
		$this->layout = 'admin';
		$this->AclFilter->auth();
	  }else{
		$this->Auth->authenticate = array(
		    AuthComponent::ALL => array(
			  'userModel' => 'User',
			  'fields' => array(
				'username' => 'username',
				'password' => 'password',
			  ),
			  'scope' => array(
				'User.role_id' => ROLE_ID_EXAMINEE,
				'User.status' => STATUS_ACTIVE,
			  ),
		    ),
		    'Form',
		);
		$this->Auth->logoutRedirect = $this->Auth->loginAction = array(
			'plugin' => null,
			'controller' => 'users',
			'action' => 'login',
		);
		$this->Auth->loginRedirect = array(
			'plugin' => null,
			'controller' => 'users',
			'action' => 'dashboard',
		);
	  }
    }

    public function blackhole($type) {
	  // handle errors.
    }

    public function _setErrorLayout() {
	  if ($this->name == 'CakeError') {
		$this->layout = 'error';
	  }
    }

    public function beforeRender() {
	  $this->_setErrorLayout();
    }

}
