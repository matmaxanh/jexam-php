<?php
/**
 * AclAro Model
 *
 */
class AclAro extends AppModel {

/**
 * name
 *
 * @var string
 */
	public $name = 'AclAro';

/**
 * useTable
 *
 * @var string
 */
	public $useTable = 'aros';

/**
 * actsAs
 *
 * @var array
 */
	public $actsAs = array('Tree');

}
