<?php
App::uses('HelpdeskProblemsCounter', 'Model');

/**
 * HelpdeskProblemsCounter Test Case
 *
 */
class HelpdeskProblemsCounterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_problems_counter',
		'app.helpdesk_transaction',
		'app.helpdesk_transaction_type',
		'app.helpdesk_transaction_unit',
		'app.helpdesk_transaction_unit_pic',
		'app.user',
		'app.department',
		'app.role'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskProblemsCounter = ClassRegistry::init('HelpdeskProblemsCounter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskProblemsCounter);

		parent::tearDown();
	}

}
