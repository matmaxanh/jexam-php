<?php

App::uses('AppModel', 'Model');

/**
 * Classroom Model
 *
 * @property Grade $Grade
 * @property Course $Course
 * @property Teacher $Teacher
 */
class Classroom extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    
    public $actsAs = array('Containable');


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
	  'Grade' => array(
		'className' => 'Grade',
		'foreignKey' => 'grade_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
	  'Course' => array(
		'className' => 'Course',
		'foreignKey' => 'course_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	  ),
	  'Teacher' => array(
		'className' => 'User',
		'foreignKey' => 'teacher_id',
		'conditions' => array('Teacher.role_id' => 3),
		'fields' => '',
		'order' => ''
	  )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
	  'Exam' => array(
		'className' => 'Exam',
		'foreignKey' => 'class_id',
		'dependent' => false,
		'conditions' => '',
		'fields' => '',
		'order' => '',
	  )
    );

}
