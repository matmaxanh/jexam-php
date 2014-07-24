<?php
/**
 * SyncLogFixture
 *
 */
class SyncLogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'original_id' => array('type' => 'biginteger', 'null' => false, 'default' => null),
		'replica_id' => array('type' => 'biginteger', 'null' => false, 'default' => null),
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
			'id' => null,
			'model' => 'Lorem ipsum dolor sit amet',
			'original_id' => 'Lorem ipsum dolor sit amet',
			'replica_id' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-03-28 02:57:18',
			'updated' => '2013-03-28 02:57:18'
		),
	);

}
