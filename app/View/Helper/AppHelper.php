<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {
	function hasPermission($url) {

		if (!is_array($url)) {
			return false;
		}

		extract($url);

		if(isset($plugin)) {
			$plugin = Inflector::camelize($plugin);
		}

		if (!isset($controller)) {
			$controller = $this->params['controller'];
		}
		$controller = Inflector::camelize($controller);

		if (!isset($action)) {
			$action = $this->params['action'];
		}

		$_admin = Configure::read('Routing.admin');

		if ((isset(${$_admin}) && ${$_admin}) || $this->params['action'][$_admin]) {
			$action = $_admin.'_'.$action;
		}

		if(isset($plugin) and !empty($plugin)) {
			$controller = $plugin.'/'.$controller;
		}

		$permission = 'controllers/'.$controller.'/'.$action;

		return in_array($permission, $this->Session->read('Auth.Permissions'));

	}
}
