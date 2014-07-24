<?php
App::uses('AppController', 'Controller');
/**
 * Courses Controller
 *
 * @property Course $Course
 */
class CoursesController extends AppController {

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
					if(isset($_POST['course'])){
						$courseIds = explode(",", $_POST['course']);
						$this->Course->deleteAll(array('id'=> $courseIds));
					}
					break;
			}
		}
		$this->__getGridData();
		$this->render('/Elements/backend/course_grid');
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Course->exists($id)) {
			throw new NotFoundException(__('Invalid course'));
		}
		$options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
		$this->set('course', $this->Course->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Course->create();
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been saved'));
				if($this->request->data['Course']['task'] == 'save2new'){
					$this->redirect(array('action'=> 'add'));
				}else{
					$this->redirect(array('action'=> 'index'));
				}
			} else {
				$this->Session->setFlash(__('The course could not be saved. Please, try again.'));
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
		if (!$this->Course->exists($id)) {
			throw new NotFoundException(__('Invalid course'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been saved'));
				if($this->request->data['Course']['task'] == 'save2new'){
					$this->redirect(array('action'=> 'add'));
				}else{
					$this->redirect(array('action'=> 'index'));
				}
			} else {
				$this->Session->setFlash(__('The course could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
			$this->request->data = $this->Course->find('first', $options);
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
			$courses = $this->paginate();
		}else{
			$courses = $this->Course->find('all', array(
				'conditions'=> $conditions,
			));
		}

		$courseIds = array();
		foreach($courses as $course){
			$courseIds[] = $course['Course']['id'];
		}
		$this->set(compact('courses', 'courseIds'));
	}
}
