<?php

App::uses('AppController', 'Controller');

/**
 * Exams Controller
 *
 * @property Exam $Exam
 */
class ExamsController extends AppController {

    public $uses = array('Exam', 'QuestionType', 'Subject', 'User');

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
	  $this->__getGridData();
    }

    public function admin_grid() {
	  $this->layout = 'ajax';
	  if (isset($_POST['action'])) {
		switch ($_POST['action']) {
		    case 'delete':
			  if (isset($_POST['exam'])) {
				$examIds = explode(",", $_POST['exam']);
				foreach ($examIds as $examId) {
				    $this->Exam->delete($examId);
				}
			  }
			  break;
		}
	  }
	  $this->__getGridData();
	  $this->render('/Elements/backend/exam_grid');
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
	  if (!$this->Exam->exists($id)) {
		throw new NotFoundException(__('Invalid exam'));
	  }
	  $options = array('contain' => array('Subject'), 'conditions' => array('Exam.' . $this->Exam->primaryKey => $id));
	  $exam = $this->Exam->find('first', $options);
	  $questionTypes = $this->QuestionType->find('list', array(
		'conditions' => array('QuestionType.id' => explode(",", $exam['Exam']['question_type_ids']))
	  ));
	  $exam['Exam']['question_type'] = implode(",", $questionTypes);
	  $this->set(compact('exam'));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
	  if ($this->request->is('post') && isset($this->request->data['Exam']['question_type'])) {
		if(empty($this->request->data['Exam']['question_type'])){
		    Common::setFlash(__('Question type is required.'));
		}else{
		    $this->Exam->create();
		    if ($this->Exam->save($this->request->data)) {
			  Common::setFlash(__('The exam has been saved'), 'success');
			  
			  //save question type of exam
			  $examId = $this->Exam->getLastInsertID();
			  $data = array();
			  foreach($this->request->data['Exam']['question_type'] as $questionTypeId){
				$data[] = array(
				    'exam_id' => $examId,
				    'question_type_id' => $questionTypeId
				);
			  }
			  $this->Exam->ExamQType->saveAll($data);
			  
			  //if status of exam is active, generate password for examinee
			  if(isset($this->request->data['Exam']['class_id']) && $this->request->data['Exam']['status'] == STATUS_EXAM_ACTIVE){
				$passwordCode = $this->User->generateRandomPassword($this->request->data['Exam']['class_id']);
				$this->Exam->saveField('password_code', $passwordCode);
			  }
			  
			  //redirect
			  if ($this->request->data['Exam']['task'] == 'save2new') {
				$this->redirect(array('action' => 'add'));
			  } else {
				$this->redirect(array('action' => 'index'));
			  }
		    } else {
			  Common::setFlash($this->Exam->validationErrors);
		    }
		}
	  }
	  $classes = $this->Exam->Class->find('list');
	  $subjects = $this->Exam->Subject->find('list', array(
		'contain' => array('ParentSubject'),
		'conditions' => array('Subject.parent_id !=' => null),
		'fields' => array('Subject.id', 'Subject.name', 'ParentSubject.name'),
	  ));
	  $questionTypes = $this->QuestionType->find('list');
	  $difficulties = $this->Exam->Difficulty->find('list');
	  $this->set(compact('classes', 'subjects', 'questionTypes', 'difficulties'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
	  if (!$this->Exam->exists($id)) {
		throw new NotFoundException(__('Invalid exam'));
	  }
	  if ($this->request->is('post') || $this->request->is('put')) {
		$exam = $this->Exam->find('first', array(
		    'fields' => array('Exam.status'),
		    'conditions' => array('Exam.id' => $id),
		));
		
		//TODO: improve update
		//update question type
		$this->Exam->ExamQType->deleteAll(array('exam_id' => $id));
		$data = array();
		foreach($this->request->data['Exam']['question_type'] as $questionTypeId){
		    $data[] = array(
			  'exam_id' => $id,
			  'question_type_id' => $questionTypeId
		    );
		}
		$this->Exam->ExamQType->saveAll($data);
		
		$this->Exam->id = $id;
		if ($this->Exam->save($this->request->data)) {
		    Common::setFlash(__('The exam has been saved'), 'success');
		    
		    //When change status of exam to active, generate password for examinee
		    if(isset($this->request->data['Exam']['class_id']) 
			  && $exam['Exam']['status'] != $this->request->data['Exam']['status'] 
			  && $this->request->data['Exam']['status'] == STATUS_EXAM_ACTIVE){
			  $passwordCode = $this->User->generateRandomPassword($this->request->data['Exam']['class_id']);
			  $this->Exam->saveField('password_code', $passwordCode);
    		    }
		    
		    if ($this->request->data['Exam']['task'] == 'save2new') {
			  $this->redirect(array('action' => 'add'));
		    } else {
			  $this->redirect(array('action' => 'index'));
		    }
		} else {
		    Common::setFlash(__('The exam could not be saved. Please, try again.'));
		}
	  } else {
		$exam = $this->Exam->find('first', array(
		    'conditions' => array('Exam.' . $this->Exam->primaryKey => $id)
		));
		$exam['Exam']['question_type'] = $this->Exam->ExamQType->find('list', array(
		    'fields' => array('id', 'question_type_id'),
		    'conditions' => array('ExamQType.exam_id' => $id),
		));
		$exam['Exam']['duration'] = gmdate("H:i:s", $exam['Exam']['duration']);
		$this->request->data = $exam;
	  }
	  
	  $classes = $this->Exam->Class->find('list');
	  $subjects = $this->Exam->Subject->find('list', array(
		'contain' => array('ParentSubject'),
		'conditions' => array('Subject.parent_id !=' => null),
		'fields' => array('Subject.id', 'Subject.name', 'ParentSubject.name'),
	  ));
	  $questionTypes = $this->QuestionType->find('list');
	  $difficulties = $this->Exam->Difficulty->find('list');
	  
	  $this->set(compact('classes', 'subjects', 'questionTypes', 'difficulties'));
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
		$this->paginate = array(
		    'paramType' => 'querystring',
		    'contain' => array('Subject.name'),
		    'conditions' => $conditions,
		    'limit' => $limit,
		);
		$exams = $this->paginate();
	  } else {
		$exams = $this->Exam->find('all', array(
		    'contain' => array('Subject.name'),
		    'conditions' => $conditions,
		));
	  }

	  $examIds = array();
	  foreach ($exams as $exam) {
		$examIds[] = $exam['Exam']['id'];
	  }

	  $this->set(compact('exams', 'examIds'));
    }

}
