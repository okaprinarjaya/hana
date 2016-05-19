<?php
App::uses('HelpdeskTransactionUnit', 'Model');

/**
 * HelpdeskTransactionUnit Test Case
 *
 */
class HelpdeskTransactionUnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_transaction_unit',
		'app.helpdesk_transaction',
		'app.helpdesk_transaction_type',
		'app.helpdesk_sla',
		'app.helpdesk_ticket'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskTransactionUnit = ClassRegistry::init('HelpdeskTransactionUnit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskTransactionUnit);

		parent::tearDown();
	}

}
