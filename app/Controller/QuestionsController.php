<?php

App::uses('AppController', 'Controller');

/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {

    var $uses = array('Question', 'QuestionType', 'Subject');

    public function beforeFilter() {
	  parent::beforeFilter();
    }

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
			  if (isset($_POST['question'])) {
				$questionIds = explode(",", $_POST['question']);
				if ($this->Auth->user('role_id') === ROLE_ID_SUPERADMIN) {
				    $this->Question->deleteAll(array('Question.id' => $questionIds));
				} else {
				    //kiem tra quyen xoa cau hoi
				    //for manager ( role id is 4)
				    $this->Question->updateAll(array(
					  'Question.is_deleted' => STATUS_ACTIVE,
					  'Question.deleted_at' => date('Y-m-d H:i:s'),
						), array(
					  'Question.status !=' => STATUS_QUESTION_CHECKED,
					  'Question.id' => $questionIds,
				    ));
				}
			  }
			  break;
		}
	  }
	  $this->__getGridData();
	  $this->render('/Elements/backend/question_grid');
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add($questionTypeId = null) {
	  $pageTitle = __('Add new question');
	  if (!is_null($questionTypeId) && $this->request->is('post')) {
		$this->request->data['Question']['question_type_id'] = $questionTypeId;
		$this->Question->create();
		//default status of question = STATUS_QUESTION_OPEN
		$this->request->data['Question']['status'] = STATUS_QUESTION_OPEN;
		$this->Question->set($this->request->data);
		if ($this->Question->validates()) {
		    $this->Question->save($this->request->data, false);

		    Common::setFlash(__('The question has been saved'), 'success');
		    if ($this->request->data['Question']['task'] == 'save2new') {
			  $this->redirect(array('action' => 'add', $questionTypeId));
		    } else {
			  $this->redirect(array('action' => 'index'));
		    }
		} else {
		    $errors = array();
		    foreach ($this->Question->validationErrors as $error) {
			  $errors[] = $error[0];
		    }
		    Common::setFlash($errors);
		}
	  }
	  $subjects = $this->Subject->find('list', array(
		'recursive' => -1,
		'fields' => array('Subject.id', 'Subject.name'),
		'conditions' => array('Subject.parent_id !=' => null)
	  ));
	  $this->set(compact('questionTypeId', 'pageTitle', 'subjects'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $qid
     * @return void
     */
    public function admin_edit($qid = null) {
	  if (!$this->Question->exists($qid)) {
		throw new NotFoundException(__('Invalid question'));
	  }
	  if ($this->request->is('post') || $this->request->is('put')) {
		if ($this->Question->save($this->request->data)) {
		    Common::setFlash(__('The question has been saved'), 'success');
		    if ($this->request->data['Question']['task'] == 'save2new') {
			  $this->redirect(array('action' => 'add'));
		    } else {
			  $this->redirect(array('action' => 'index'));
		    }
		} else {
		    Common::setFlash(__('The question could not be saved. Please, try again.'));
		}
	  } else {
		$options = array('conditions' => array('Question.' . $this->Question->primaryKey => $qid));
		$this->request->data = $this->Question->find('first', $options);
	  }
	  $questionTypeId = $this->Question->field('question_type_id', array('id' => $qid));
	  $subjects = $this->Subject->find('list', array(
		'recursive' => -1,
		'fields' => array('Subject.id', 'Subject.name'),
		'conditions' => array('Subject.parent_id !=' => null)
	  ));
	  $this->set(compact('questionTypeId', 'subjects'));
    }

    private function __getGridData($hasPagination = true, $filterConditions = array()) {
	  $displayAuthor = false;
	  $displayAnswer = true;
	  $defaultConditions = array('Question.is_deleted' => STATUS_DISABLE);
	  //set default condition by user role
	  //for manager ( role id is 4)
	  if ($this->Auth->user('role_id') == 4) {
		$defaultConditions = array_merge($defaultConditions, array('Question.author_id' => $this->Auth->user('id')));
	  }

	  //default conditions for find questions.
	  $contain = array('QuestionType', 'Subject');
	  $conditions = array_merge($defaultConditions, $filterConditions);
	  $order = array('Question.status' => 'DESC', 'Question.created' => 'DESC');
	  if (isset($_GET['limit'])) {
		$limit = $_GET['limit'];
	  } else {
		$limit = Configure::read('Setting.rows_per_page');
	  }
	  if ($hasPagination) {
		$this->paginate = array('Question' => array(
			  'paramType' => 'querystring',
			  'contain' => $contain,
			  'conditions' => $conditions,
			  'limit' => $limit,
			  'order' => $order,
		));
		try {
		    $questions = $this->paginate('Question');
		} catch (Exception $e) {
		    $this->request->query['page'] = 1;
		    $questions = $this->paginate('Question');
		}
	  } else {
		$questions = $this->Question->find('all', array(
		    'contain' => $contain,
		    'conditions' => $conditions,
		    'order' => $order,
		));
	  }
	  $questionTypes = $this->Question->QuestionType->find('list', array(
		'recursive' => -1,
		'fields' => array('QuestionType.id', 'QuestionType.name'),
	  ));

	  $questionIds = array();
	  foreach ($questions as $question) {
		$questionIds[] = $question['Question']['id'];
	  }

	  $this->set(compact('questionTypes', 'questions', 'displayAuthor', 'displayAnswer', 'questionIds'));
    }

}
