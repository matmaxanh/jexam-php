<?php
App::uses('AppController', 'Controller');
/**
 * Profile Controller
 *
 */
class ProfileController extends AppController {

	public $uses = array('User', 'Role');

	public $helpers = array('Layout');

	function beforeFilter(){
		parent::beforeFilter();
	}
	
    public function admin_view(){
        $options = array(
            'conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id'))
        );
        $user = $this->User->find('first', $options);
        $this->set(compact('user'));
    }
    
    public function admin_edit(){
        $id = $this->Auth->user('id');
        if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            //if empty password, don't check password confirm
			if (isset($this->request->data['User']['passwd']) && empty($this->request->data['User']['passwd']) && isset($this->request->data['User']['passwd_confirm'])){
				unset($this->request->data['User']['passwd']);
				unset($this->request->data['User']['passwd_confirm']);
			}
            
            $this->User->id = $id;
			if ($this->User->save($this->request->data)) {
				Common::setFlash(__('The user has been saved'), 'success');
				if($this->request->data['User']['task'] == 'save2new'){
					$this->redirect(array('action'=> 'add'));
				}else{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				Common::setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
    }
}
