<?php

App::uses('AppModel', 'Model');

/**
 * Exam Model
 *
 * @property Exam $Exam
 */
class Exam extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $actsAs = array('Containable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
	  'name' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		    'message' => 'Name is required.',
		),
	  ),
	  'category_id' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		    'message' => 'Category is required.',
		    'last' => true,
		),
		'numeric' => array(
		    'rule' => array('numeric'),
		    'message' => 'Category Id must be numeric.',
		),
	  ),
	  'duration' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		    'message' => 'Duration is required.',
		    'last' => true,
		),
		'naturalNumber' => array(
		    'rule' => array('naturalNumber'),
		    'message' => 'Duration must is invalid.',
		),
	  ),
	  'question_number' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		    'message' => 'Question number is required.',
		    'last' => true,
		),
		'numeric' => array(
		    'rule' => array('naturalNumber'),
		    'message' => 'Question number is invalid.',
		),
	  ),
	  'pass_score' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		    'message' => 'Pass score is required.',
		    'last' => true,
		),
		'numeric' => array(
		    'rule' => array('numeric'),
		    'message' => 'Pass score must be numeric.',
		),
	  ),
	  'status' => array(
		'notempty' => array(
		    'rule' => array('notempty'),
		    'message' => 'Status is required.',
		),
	  ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
	  'Class' => array(
		'className' => 'Classroom',
		'foreignKey' => 'class_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
	  'Subject' => array(
		'className' => 'Subject',
		'foreignKey' => 'subject_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
	  'Difficulty' => array(
		'className' => 'Difficulty',
		'foreignKey' => 'difficulty',
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
	  'ExamQType' => array(
		'className' => 'ExamQType',
		'foreignKey' => 'exam_id',
		'dependent' => false,
		'conditions' => '',
		'fields' => '',
		'order' => '',
	  )
    );

    public function beforeValidate() {
	  if (isset($this->data['Exam']['duration']) && !empty($this->data['Exam']['duration'])) {
		list($hours, $mins, $secs) = explode(':', $this->data['Exam']['duration']);
		$this->data['Exam']['duration'] = mktime($hours, $mins, $secs) - mktime(0, 0, 0);
	  }
	  return true;
    }
    
}
