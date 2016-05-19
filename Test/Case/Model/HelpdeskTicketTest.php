<?php
App::uses('HelpdeskTicket', 'Model');

/**
 * HelpdeskTicket Test Case
 *
 */
class HelpdeskTicketTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_ticket',
		'app.helpdesk_transaction_unit',
		'app.helpdesk_transaction',
		'app.helpdesk_transaction_type',
		'app.helpdesk_atm',
		'app.helpdesk_bank'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskTicket = ClassRegistry::init('HelpdeskTicket');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskTicket);

		parent::tearDown();
	}

}
