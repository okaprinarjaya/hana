<?php
App::uses('HelpdeskCustomerQuestion', 'Model');

/**
 * HelpdeskCustomerQuestion Test Case
 *
 */
class HelpdeskCustomerQuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_customer_question',
		'app.helpdesk_question_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskCustomerQuestion = ClassRegistry::init('HelpdeskCustomerQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskCustomerQuestion);

		parent::tearDown();
	}

}
