<?php

App::uses('AppController', 'Controller');

/**
 * Exams Controller
 *
 * @property Exam $Exam
 */
class TestsController extends AppController {

    public $uses = array('Exam', 'TestQuestion', 'Test', 'Question');

    /*
     * display exam 
     */

    public function view() {
	  if (($this->request->is('post') || $this->request->is('put')) && isset($this->request->data['Exam']['id'])) {
		try {
		    if (!$this->Session->check('Auth.User.test_id')) {
			  //TODO: change algorithm encode data
			  $examId = $this->request->data['Exam']['id'];
			  if (!$this->Exam->exists($examId)) {
				throw new NotFoundException(__('Invalid exam'));
			  }
			  if ($this->Test->build($examId, $this->Auth->user('id'))) {
				$testId = $this->Test->getLastInsertID();
				$this->Session->write('Auth.User.test_id', $testId);
			  } else {
				throw new NotFoundException(__('Invalid create exam'));
			  }
		    }
		    $this->redirect('/testing');
		} catch (Exception $e) {
		    $this->log($e->getMessage(), 'error');
		    Common::setFlash(__('The system has a error. Please, try again.'));
		}
	  }

	  $exam = $this->Exam->find('first', array(
		'fields' => array('Exam.name', 'Exam.description', 'Exam.question_number', 'Exam.pass_score', 'Exam.duration'),
		'conditions' => array('Exam.class_id' => $this->Auth->user('class_id'), 'Exam.status' => STATUS_EXAM_ACTIVE),
	  ));
	  if (empty($exam)) {
		throw new NotFoundException(__('Invalid exam'));
	  }

	  $this->set(compact('exam'));
    }

    /**
     * display each question for user when user do test.
     */
    public function excute() {
	  try {
		if (!$this->Session->check('Auth.User.test_id')) {
		    throw new NotFoundException('Could not find any test');
		}
		$testId = $this->Auth->user('test_id');
		$test = $this->Test->find('first', array(
		    'contain' => array('Exam.name', 'Exam.question_number'),
		    'conditions' => array('Test.examinee_id' => $this->Auth->user('id'), 'Test.id' => $testId),
		));
		if (empty($test)) {
		    throw new NotFoundException(__('Invalid test'));
		}

		if (($this->request->is('post') || $this->request->is('put')) &&
			  isset($this->request->data['Test']['qid']) && isset($this->request->data['Test']['answer'])) {
		    /*
		     * check time of exam
		     * if remain time doesn't run out, update answer
		     * @todo: prevent to change question id in hidden input.
		     */
		    $currentTime = time();
		    $doneQuestionNumber = intval($test['Test']['done_question_number']);
		    $questionNumber = intval($test['Exam']['question_number']);
		    if (($currentTime < intval($test['Test']['end_time'])) && ($doneQuestionNumber < $questionNumber)) {
			  $testQuestion = $this->TestQuestion->find('first', array(
				'recursive' => -1,
				'conditions' => array(
				    'TestQuestion.id' => $this->request->data['Test']['qid'],
				    'TestQuestion.test_id' => $testId,
				    'TestQuestion.user_choice' => null
				),
			  ));
			  if (empty($testQuestion)) {
				throw new NotFoundException(__('Invalid question'));
			  }
			  if (is_array($this->request->data['Test']['answer'])) {
				$userChoices = implode(",", sort($this->request->data['Test']['answer']));
			  } else {
				$userChoices = $this->request->data['Test']['answer'];
			  }
			  $doneQuestionNumber += 1;
			  $this->TestQuestion->id = $this->request->data['Test']['qid'];
			  if ($this->TestQuestion->saveField('user_choice', $userChoices)) {
				$this->request->data = array();

				$this->Test->id = $testId;
				$this->Test->saveField('done_question_number', $doneQuestionNumber);

				//if test is completed
				if ($questionNumber == $doneQuestionNumber) {
				    $this->Test->updateResult($testId);
				    $this->Session->delete('Auth.User.test_id');
				    $this->redirect(array('controller' => 'tests', 'action' => 'result', $testId));
				}
			  } else {
				Common::setFlash(__('The system has a error. Please try again.'));
				throw new NotFoundException('Answer could not saved');
			  }
		    } else {
			  $this->Test->updateResult($testId);
			  $this->Session->delete('Auth.User.testId');
			  $this->redirect(array('controller' => 'tests', 'action' => 'result', $testId));
		    }
		}

		//get content of next question
		$question = $this->TestQuestion->getByTest($testId);
		$this->set(compact('test', 'question'));
	  } catch (Exception $e) {
		$this->log('Error : ' . $e->getMessage(), 'error');
		$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
	  }
    }

    public function result($testId) {
	  $test = $this->Test->find('first', array(
		'contain' => array('Exam.name', 'Exam.question_number', 'Exam.pass_score'),
		'conditions' => array('Test.examinee_id' => $this->Auth->user('id'), 'Test.id' => $testId, 'Test.is_completed' => STATUS_ACTIVE),
	  ));
	  if (empty($test)) {
		throw new NotFoundException(__('Invalid test'));
	  }

	  $this->set(compact('test'));
    }

}
