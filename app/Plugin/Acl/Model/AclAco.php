<?php
/**
 * AclAco Model
 *
 */
class AclAco extends AppModel {

/**
 * name
 *
 * @var string
 */
	public $name = 'AclAco';

/**
 * useTable
 *
 * @var string
 */
	public $useTable = 'acos';

/**
 * actsAs
 *
 * @var array
 */
	public $actsAs = array('Tree');

}
