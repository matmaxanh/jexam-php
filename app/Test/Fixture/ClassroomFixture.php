<?php
/**
 * ClassroomFixture
 *
 */
class ClassroomFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'grade_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'course_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 20),
		'teacher_id' => array('type' => 'biginteger', 'null' => true, 'default' => null),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'grade_id' => 1,
			'course_id' => 1,
			'teacher_id' => '',
			'created' => '2013-09-22 15:36:46',
			'updated' => '2013-09-22 15:36:46'
		),
	);

}
