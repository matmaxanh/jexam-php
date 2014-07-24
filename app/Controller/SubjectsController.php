<?php

App::uses('AppController', 'Controller');

/**
 * Subjects Controller
 *
 * @property Subject $Subject
 */
class SubjectsController extends AppController {

    public $uses = array('Subject');

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
	  $this->__getGridData();
    }

    /*
     * admin_grid method
     * 
     * @return void 
     */

    public function admin_grid() {
	  $this->layout = 'ajax';
	  if (isset($_POST['action'])) {
		switch ($_POST['action']) {
		    case 'delete':
			  if (isset($_POST['subject'])) {
				$subjectIds = explode(",", $_POST['subject']);
				foreach ($subjectIds as $subjectId) {
				    $this->Subject->delete($subjectId);
				}
			  }
			  break;
		}
	  }
	  $this->__getGridData();
	  $this->render('/Elements/backend/subject_grid');
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
	  if ($this->request->is('post')) {
		$this->Subject->create();
		if ($this->Subject->save($this->request->data)) {
		    Common::setFlash(__('The subject has been saved'), 'success');
		    if ($this->request->data['Subject']['task'] == 'save2new') {
			  $this->redirect(array('action' => 'add'));
		    } else {
			  $this->redirect(array('action' => 'index'));
		    }
		} else {
		    Common::setFlash(__('The subject could not be saved. Please, try again.'));
		}
	  }
	  $parentSubjects = $this->Subject->ParentSubject->find('list', array(
		'fields' => array('ParentSubject.id', 'ParentSubject.name'),
		'conditions' => array('ParentSubject.parent_id' => null),
	  ));
	  $this->set(compact('parentSubjects'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
	  if (!$this->Subject->exists($id)) {
		throw new NotFoundException(__('Invalid subject'));
	  }
	  if ($this->request->is('post') || $this->request->is('put')) {
		if ($this->Subject->save($this->request->data)) {
		    Common::setFlash(__('The subject has been saved'), 'success');
		    $this->redirect(array('action' => 'index'));
		} else {
		    Common::setFlash(__('The subject could not be saved. Please, try again.'));
		}
	  } else {
		$this->request->data = $this->Subject->find('first', array(
		    'recursive' => -1,
		    'conditions' => array('Subject.' . $this->Subject->primaryKey => $id),
		));
	  }
	  $parentSubjects = $this->Subject->ParentSubject->find('list', array(
		'fields' => array('ParentSubject.id', 'ParentSubject.name'),
		'conditions' => array('ParentSubject.parent_id' => null),
	  ));
	  $this->set(compact('parentSubjects'));
    }

    /*
     * get grid data for index page
     * 
     * @param boolean $hasPagination
     * @return void
     */
    private function __getGridData($hasPagination = true) {
	  $conditions = array();
	  if (isset($_GET['limit'])) {
		$limit = $_GET['limit'];
	  } else {
		$limit = Configure::read('Setting.rows_per_page');
	  }
	  if ($hasPagination) {
		$this->paginate = array('Subject' => array(
		    'paramType' => 'querystring',
		    'contain' => array('ParentSubject'),
		    'conditions' => $conditions,
		    'order' => 'Subject.lft ASC',
		    'limit' => $limit,
		));
		$subjects = $this->paginate('Subject');
	  } else {
		$subjects = $this->Subject->find('all', array(
		    'contain' => array('ParentSubject'),
		    'conditions' => $conditions,
		    'order' => 'Subject.lft ASC',
		));
	  }

	  $subjectIds = array();
	  foreach ($subjects as $subject) {
		$subjectIds[] = $subject['Subject']['id'];
	  }
	  $this->set(compact('subjects', 'subjectIds'));
    }

}
