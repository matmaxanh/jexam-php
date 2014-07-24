<?php
/**
 * ExamQtypeFixture
 *
 */
class ExamQtypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'primary'),
		'exam_id' => array('type' => 'biginteger', 'null' => false, 'default' => null),
		'question_type_id' => array('type' => 'biginteger', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'exam_id' => '',
			'question_type_id' => '',
			'created' => '2013-09-27 16:41:32',
			'updated' => '2013-09-27 16:41:32'
		),
	);

}
