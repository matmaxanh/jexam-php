<?php

App::uses('AppModel', 'Model');

/**
 * Question Model
 *
 * @property QuestionType $QuestionType
 * @property Answer $Answer
 * @property Feedback $Feedback
 */
class Question extends AppModel {

    public $actsAs = array('Containable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
	  'question_type_id' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		//'message' => 'Your custom message here',
		//'allowEmpty' => false,
		//'required' => false,
		//'last' => false, // Stop validation after this rule
		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	  ),
	  'content' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		    'message' => 'You must fill content',
		//'allowEmpty' => false,
		//'required' => false,
		//'last' => false, // Stop validation after this rule
		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	  ),
	  'score' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		//'message' => 'Your custom message here',
		//'allowEmpty' => false,
		//'required' => false,
		//'last' => false, // Stop validation after this rule
		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	  ),
	  'difficulty' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		//'message' => 'Your custom message here',
		//'allowEmpty' => false,
		//'required' => false,
		//'last' => false, // Stop validation after this rule
		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	  ),
	  'answer' => array(
		'minAnswer' => array(
		    'rule' => array('validateMinNumberAnswer'),
		    'message' => 'You must have at least 5 answer options.',
		),
		'correctAnswer' => array(
		    'rule' => array('validateCorrectAnswer'),
		    'message' => 'You must have a correct question.',
		),
	  ),
    );

    function validateMinNumberAnswer() {
	  $answers = json_decode($this->data['Question']['answer'], true);
	  if (count($answers) >= MIN_ANSWER_NUMBER) {
		return true;
	  }
	  return false;
    }

    function validateCorrectAnswer() {
	  $answers = json_decode($this->data['Question']['answer'], true);
	  foreach ($answers as $answer) {
		if ($answer['correctAnswer']) {
		    return true;
		}
	  }
	  return false;
    }

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
	  'QuestionType' => array(
		'className' => 'QuestionType',
		'foreignKey' => 'question_type_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
	  'Subject' => array(
		'className' => 'Subject',
		'foreignKey' => 'subject_id',
		'conditions' => '',
		'fields' => '',
		'order' => '',
	  ),
    );

    function beforeSave() {
	  if (isset($this->data['Question']['content'])) {
		$this->data['Question']['content'] = htmlspecialchars($this->data['Question']['content']);
	  }
	  return true;
    }

    /*
     * decode html content of question
     * 
     */

    public function afterFind($results) {
	  foreach ($results as $key => $val) {
		if (isset($val['Question']['content'])) {
		    $results[$key]['Question']['content'] = html_entity_decode($val['Question']['content']);
		}
	  }
	  return $results;
    }

    /*
     * check permission for update question
     * 
     * @params int $questionId
     * @params int $roleId
     * @params int $userId
     * @return boolean 
     */

    public function checkUpdatePermission($questionId, $roleId, $userId) {

	  return true;
    }

    /**
     * create list question for exam.
     * save each question into database
     *
     * @param $examId int id of exam
     * @param $testId int id of test
     * 
     * @return void create questions of exam in database.
     */
    public function getQuestionByExam($exam) {
	  $difficultyFields = array();
	  for ($i = MIN_DIFFICULTY_QUESTION; $i <= MAX_DIFFICULTY_QUESTION; $i++) {
		$difficultyFields[] = 'difficulty_' . $i;
	  }

	  $questionTypes = array();
	  foreach ($exam['ExamQType'] as $row) {
		$questionTypes[] = $row['question_type_id'];
	  }

	  //get question number by difficulty
	  $questions = $this->find('all', array(
		'recursive' => -1,
		'fields' => array('COUNT(Question.id) as number', 'Question.difficulty'),
		'conditions' => array(
		    'Question.subject_id' => $exam['Exam']['subject_id'],
		    'Question.status' => STATUS_ACTIVE,
		    'Question.question_type_id' => $questionTypes,
		),
		'group' => 'Question.difficulty',
		'order' => array('Question.difficulty' => 'DESC'),
	  ));

	  //array difficulty => question number of a test.
	  $questionData = array();
	  foreach ($questions as $row) {
		$questionData[intval($row['Question']['difficulty'])] = intval($row[0]['number']);
	  }

	  $difficulties = array();
	  foreach ($exam['Difficulty'] as $fieldName => $percentage) {
		//except field is not difficulty setting and difficulty is not set percentage
		if(!in_array($fieldName, $difficultyFields) || empty($percentage)){
		    continue;
		}
		
		//get difficulty from string with format difficulty_%
		$difficulty = substr($fieldName, 11);
		$difficulties[$difficulty] = intval($percentage);
	  }

	  //sort by percentage
	  asort($difficulties);

	  //array contain request question number by difficulty
	  $requests = array();
	  $questionNumber = intval($exam['Exam']['question_number']);
	  $i = $total = 0;
	  foreach ($difficulties as $dificulty => $percentage) {
		$i++;
		if ($i < count($difficulties)) {
		    $number = intval(floor($percentage * $questionNumber / 100));
		    $total += $number;
		} else {
		    //difficulty has largest percentage
		    $number = $questionNumber - $total;
		}
		if (empty($number)) {
		    continue;
		}
		$requests[$dificulty] = $number;
	  }

	  return $this->__getQuestion($exam, $requests, $questionData, $questionTypes);
    }

    /*
     * get question
     * 
     * @param array $exam exam information
     * @param array $requests contain request question number by difficulty
     * @param array $questionData contain question number by difficulty in database
     * @param array $questionTypes type of question
     * @return array
     */

    private function __getQuestion($exam, $requests, $questionData, $questionTypes) {
	  
	  //question number don't 
	  $remainNumber = 0;
	  foreach ($requests as $dificulty => &$requestNumber) {
		//if hasn't any question which is same difficulty, plus question number into remain_number and countinue
		if (!isset($questionData[$dificulty])) {
		    $remainNumber += $requests[$dificulty];
		    unset($requests[$dificulty]);
		    continue;
		}

		if ($questionData[$dificulty] > $requestNumber) {
		    $questionData[$dificulty] -= $requestNumber;
		} else {
		    $remainNumber += $requestNumber - $questionData[$dificulty];
		    $requestNumber = $questionData[$dificulty];
		    unset($questionData[$dificulty]);
		}
	  }

	  /*
	   * if don't get enough question number
	   * we continue to get question by level from easy to hard.
	   */
	  if ($remainNumber) {
		foreach ($questionData as $difficulty => $questionNumber) {
		    if ($questionNumber > $remainNumber) {
			  $plusNumber = $remainNumber;
		    } else {
			  $plusNumber = $questionNumber;
			  $remainNumber -= $plusNumber;
		    }
		    if (isset($requests[$difficulty])) {
			  $requests[$difficulty] += $plusNumber;
		    } else {
			  $requests[$difficulty] = $plusNumber;
		    }
		    $remainNumber -= $plusNumber;
		}
	  }

	  if ($remainNumber) {
		$this->log('Question number is not enough, remain question : '.$remainNumber, LOG_ERR);
		return false;
	  }

	  //collect all question
	  $questions = array();
	  foreach ($requests as $difficulty => $number) {
		$questions = array_merge(
		    $questions, 
		    $this->__getQuestionByDifficulty($exam['Exam']['subject_id'], $questionTypes, $difficulty, $number, $exam['Exam']['answer_per_question']
		));
	  }
	  return $questions;
    }

    /**
     * get question by difficulty
     * 
     * @param int $testId id of test
     * @param array type of question
     * @param int $difficulty difficulty of question
     * @param int $number question number
     * @param int $answerNumber option number per question
     * 
     * @return array questions by difficulty
     */
    private function __getQuestionByDifficulty($subjectId, $questionTypes, $difficulty, $number, $optionNumber = MIN_ANSWER_NUMBER) {
	  $questionData = array();

	  //TODO: change query to get random data
	  $questionsByDifficulty = $this->find('all', array(
		'recursive' => -1,
		'fields' => array('Question.id', 'Question.answer', 'Question.content', 'Question.question_type_id', 'Question.score'),
		'conditions' => array(
		    'Question.subject_id' => $subjectId,
		    'Question.difficulty' => $difficulty,
		    'Question.question_type_id' => $questionTypes,
		    'Question.status' => STATUS_ACTIVE,
		),
		'order' => 'RAND()',
		'limit' => $number,
	  ));

	  foreach ($questionsByDifficulty as $question) {
		$correctOptions = $wrongOptions = array();
		foreach (json_decode($question['Question']['answer'], true) as $answer) {
		    if ($answer['correctAnswer']) {
			  $correctOptions[] = $answer['value'];
		    } else {
			  $wrongOptions[] = $answer['value'];
		    }
		}

		//get wrong answer option and suffle random answer option.
		shuffle($wrongOptions);
		$wrongOptionNumber = $optionNumber - count($correctOptions);
		$answerOptions = array_merge($correctOptions, array_splice($wrongOptions, 0, $wrongOptionNumber));
		shuffle($answerOptions);

		//get alias of correct answer
		$correctAliases = array();
		foreach ($answerOptions as $pos => $option) {
		    if (in_array($option, $correctOptions)) {
			  $correctAliases[] = chr(97 + $pos);
		    }
		    $options[chr(97 + $pos)] = $option;
		}

		//TODO: fix input type by question type id
		switch ($question['Question']['question_type_id']) {
		    case 1:
			  $inputType = 'radio';
			  break;
		    case 2:
			  $inputType = 'checkbox';
			  break;
		}

		$questionData[] = array(
		    'original_qid' => $question['Question']['id'],
		    'input_type' => $inputType,
		    'question' => $question['Question']['content'],
		    'option_choices' => $options,
		    'answer' => implode(",", $correctAliases),
		    'score' => $question['Question']['score'],
		);
	  }
	  return $questionData;
    }

}
