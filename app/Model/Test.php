<?php

App::uses('AppModel', 'Model');
App::uses('Question', 'Model');

/**
 * Test Model
 *
 * @property User $User
 * @property Exam $Exam
 * @property TestQuestion $TestQuestion
 */
class Test extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';
    public $actsAs = array('Containable');

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
	  'Exam' => array(
		'className' => 'Exam',
		'foreignKey' => 'exam_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
	  'Examinee' => array(
		'className' => 'User',
		'foreignKey' => 'examinee_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
	  'TestQuestion' => array(
		'className' => 'TestQuestion',
		'foreignKey' => 'test_id',
		'dependent' => false,
		'conditions' => '',
		'fields' => '',
		'order' => '',
		'limit' => '',
		'offset' => '',
		'exclusive' => '',
		'finderQuery' => '',
		'counterQuery' => ''
	  )
    );

    /*
     * initial list question for exam.
     */

    public function build($examId, $userId, $isPublished = STATUS_DISABLE) {
	  try {
		$exam = $this->Exam->find('first', array(
		    'contain' => array('ExamQType.question_type_id', 'Difficulty'),
		    'conditions' => array('Exam.id' => $examId)
		));
		
		$this->Question = ClassRegistry::init('Question');
		$questions = $this->Question->getQuestionByExam($exam);
		
		if (empty($questions)) {
		    throw new Exception("Can not get question of exam, id : " . $examId);
		}

		$this->create();
		$this->save(array('Test' => array(
			  'exam_id' => $examId,
			  'examinee_id' => $userId,
			  'is_published' => $isPublished,
		)));
		$testId = $this->getLastInsertID();

		$data = array();
		foreach ($questions as $k => $question) {
		    $data[] = array(
			  'test_id' => $testId,
			  'original_qid' => $question['original_qid'],
			  'order_number' => $k + 1,
			  'input_type' => $question['input_type'],
			  'question' => $question['question'],
			  'option_choices' => json_encode($question['option_choices']),
			  'answer' => $question['answer'],
			  'score' => $question['score'],
		    );
		}

		$this->id = $testId;
		return $this->save(array('Test' => array(
		    'start_time' => time(),
		    'end_time' => time() + $exam['Exam']['duration'] + DELAY_TIME)
		)) && $this->TestQuestion->saveMany($data);
	  } catch (Exception $e) {
		$this->log($e->getMessage(), 'error');
	  }
	  return false;
    }

    /*
     * update result when time run out or test is completed
     */
    public function updateResult($testId) {
	  $test = $this->find('first', array(
		'contain' => array('Exam.question_number', 'Exam.pass_score', 'TestQuestion'),
		'conditions' => array('Test.id' => $testId),
	  ));

	  if (empty($test)) {
		return false;
	  }

	  $doneQuestionAnswer = $score = 0;
	  foreach ($test['TestQuestion'] as $testQuestion) {
		if (!is_null($testQuestion['user_choice'])) {
		    $doneQuestionAnswer++;
		}
		if ($testQuestion['user_choice'] == $testQuestion['answer']) {
		    $score += intval($testQuestion['score']);
		}
	  }
	  $this->id = $testId;
	  $data = array(
		'done_question_number' => $doneQuestionAnswer,
		'score' => $score,
	  );

	  //if answer all question.
	  if ($doneQuestionAnswer == $test['Exam']['question_number']) {
		$data['is_completed'] = STATUS_ACTIVE;
		$data['finish_time'] = time();
	  }

	  //if score is higher than pass score.
	  if ($score >= intval($test['Exam']['pass_score'])) {
		$data['is_passed'] = STATUS_ACTIVE;
	  }

	  return $this->save(array('Test' => $data));
    }

}
