<?php

App::uses('AppModel', 'Model');

/**
 * TestQuestion Model
 *
 * @property Test $Test
 * @property Question $Question
 */
class TestQuestion extends AppModel {

    public $actsAs = array('Containable');


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
	  'Test' => array(
		'className' => 'Test',
		'foreignKey' => 'test_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
    );
    public $hasOne = array(
	  'Feedback' => array(
		'className' => 'Feedback',
		'foreignKey' => 'test_question_id',
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
     * get content of question which user haven't answer
     */

    public function getByTest($testId) {
	  $data = array();

	  //find first question which user don't answer.
	  $question = $this->find('first', array(
		'recursive' => -1,
		'conditions' => array('TestQuestion.test_id' => $testId, 'TestQuestion.user_choice' => null),
	  ));
	  if (empty($question)) {
		return $data;
	  }
	  $data = array(
		'id' => $question['TestQuestion']['id'],
		'order_number' => $question['TestQuestion']['order_number'],
		'content' => $question['TestQuestion']['question'],
		'input_type' => $question['TestQuestion']['input_type'],
		'answers' => json_decode($question['TestQuestion']['option_choices'], true),
	  );

	  foreach ($data['answers'] as $alias => &$content) {
		$content = '<span class="alias">' . $alias . "</span>" . $content;
	  }

	  return $data;
    }

}
