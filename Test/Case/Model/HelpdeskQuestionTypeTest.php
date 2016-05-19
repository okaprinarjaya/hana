<?php
App::uses('HelpdeskQuestionType', 'Model');

/**
 * HelpdeskQuestionType Test Case
 *
 */
class HelpdeskQuestionTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_question_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskQuestionType = ClassRegistry::init('HelpdeskQuestionType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskQuestionType);

		parent::tearDown();
	}

}
