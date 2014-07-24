<?php
App::uses('AppController', 'Controller');
/**
 * Grades Controller
 *
 * @property Grade $Grade
 */
class GradesController extends AppController {

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->__getGridData();
	}
	
	public function admin_grid(){
		$this->layout = 'ajax';
		if(isset($_POST['action'])){
			switch($_POST['action']){
				case 'delete':
					if(isset($_POST['grade'])){
						$gradeIds = explode(",", $_POST['grade']);
						$this->Grade->deleteAll(array('id'=> $gradeIds));
					}
				break;
			}
		}
		$this->__getGridData();
		$this->render('/Elements/backend/grade_grid');
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Grade->create();
			if ($this->Grade->save($this->request->data)) {
				$this->Session->setFlash(__('The grade has been saved'));
				if($this->request->data['Grade']['task'] == 'save2new'){
					$this->redirect(array('action'=> 'add'));
				}else{
					$this->redirect(array('action'=> 'index'));
				}
			} else {
				$this->Session->setFlash(__('The grade could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Grade->exists($id)) {
			throw new NotFoundException(__('Invalid grade'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Grade->save($this->request->data)) {
				$this->Session->setFlash(__('The grade has been saved'));
				if($this->request->data['Grade']['task'] == 'save2new'){
					$this->redirect(array('action'=> 'add'));
				}else{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The grade could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Grade.' . $this->Grade->primaryKey => $id));
			$this->request->data = $this->Grade->find('first', $options);
		}
	}
	
	/*
	 * get grid data for index page
	 *
	 * @param boolean $hasPagination
	 * @return void
	 */
	private function __getGridData($hasPagination = true){
		$conditions = array();
		
		if(isset($_GET['limit'])){
			$limit = $_GET['limit'];
		}else{
			$limit = Configure::read('Setting.rows_per_page');
		}
		if($hasPagination){
			$this->paginate = array(
				'paramType'=> 'querystring',
				'conditions'=> $conditions,
				'limit'=> $limit,
			);
			$grades = $this->paginate();
		}else{
			$grades = $this->Grade->find('all', array(
				'conditions'=> $conditions,
			));
		}
		
		$gradeIds = array();
		foreach($grades as $grade){
			$gradeIds[] = $grade['Grade']['id'];
		}
		$this->set(compact('grades', 'gradeIds'));
	}
}
