<?php
App::uses('ExamQtype', 'Model');

/**
 * ExamQtype Test Case
 *
 */
class ExamQtypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.exam_qtype',
		'app.exam',
		'app.classroom',
		'app.grade',
		'app.course',
		'app.user',
		'app.role',
		'app.user_category',
		'app.category',
		'app.subject',
		'app.test',
		'app.test_question',
		'app.difficulty',
		'app.question_type',
		'app.question'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ExamQtype = ClassRegistry::init('ExamQtype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ExamQtype);

		parent::tearDown();
	}

}
