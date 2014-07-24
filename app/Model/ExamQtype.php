<?php
App::uses('AppModel', 'Model');
/**
 * ExamQtype Model
 *
 * @property Exam $Exam
 * @property QuestionType $QuestionType
 */
class ExamQtype extends AppModel {


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
		'QuestionType' => array(
			'className' => 'QuestionType',
			'foreignKey' => 'question_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
