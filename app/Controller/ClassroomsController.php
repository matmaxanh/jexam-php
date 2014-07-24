<?php
App::uses('AppController', 'Controller');
/**
 * Classrooms Controller
 *
 * @property Classroom $Classroom
 */
class ClassroomsController extends AppController {

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
					if(isset($_POST['classroom'])){
                        if(is_array($_POST['classroom'])){
                            $this->Classroom->deleteAll(array('id'=> explode(",", $_POST['classroom'])));
                        }else{
                            $this->Classroom->delete($_POST['classroom']);
                        }
					}
					break;
			}
		}
		$this->__getGridData();
		$this->render('/Elements/backend/classroom_grid');
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Classroom->exists($id)) {
			throw new NotFoundException(__('Invalid classroom'));
		}
		$options = array('conditions' => array('Classroom.' . $this->Classroom->primaryKey => $id));
		$this->set('classroom', $this->Classroom->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Classroom->create();
			if ($this->Classroom->save($this->request->data)) {
				$this->Session->setFlash(__('The classroom has been saved'));
				if($this->request->data['Classroom']['task'] == 'save2new'){
					$this->redirect(array('action'=> 'add'));
				}else{
					$this->redirect(array('action'=> 'index'));
				}
			} else {
				$this->Session->setFlash(__('The classroom could not be saved. Please, try again.'));
			}
		}
		$grades = $this->Classroom->Grade->find('list');
		$courses = $this->Classroom->Course->find('list');
		$teachers = $this->Classroom->Teacher->find('list', array('conditions' => array('Teacher.role_id' => 3)));
		$this->set(compact('grades', 'courses', 'teachers'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Classroom->exists($id)) {
			throw new NotFoundException(__('Invalid classroom'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Classroom->save($this->request->data)) {
				$this->Session->setFlash(__('The classroom has been saved'));
				if($this->request->data['Classroom']['task'] == 'save2new'){
					$this->redirect(array('action'=> 'add'));
				}else{
					$this->redirect(array('action'=> 'index'));
				}
			} else {
				$this->Session->setFlash(__('The classroom could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Classroom.' . $this->Classroom->primaryKey => $id));
			$this->request->data = $this->Classroom->find('first', $options);
		}
		$grades = $this->Classroom->Grade->find('list');
		$courses = $this->Classroom->Course->find('list');
		$teachers = $this->Classroom->Teacher->find('list', array('conditions' => array('Teacher.role_id' => 3)));
		$this->set(compact('grades', 'courses', 'teachers'));
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
                'contain' => array(),
				'paramType'=> 'querystring',
				'conditions'=> $conditions,
				'limit'=> $limit,
			);
			$classrooms = $this->paginate();
		}else{
			$classrooms = $this->Classroom->find('all', array(
                'contain' => array(),
				'conditions'=> $conditions,
			));
		}
		
		$classroomIds = array();
		foreach($classrooms as $classroom){
			$classroomIds[] = $classroom['Classroom']['id'];
		}
		$this->set(compact('classrooms', 'classroomIds'));
	}

}
