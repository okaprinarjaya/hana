<?php
App::uses('HelpdeskSla', 'Model');

/**
 * HelpdeskSla Test Case
 *
 */
class HelpdeskSlaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_sla',
		'app.helpdesk_transaction_unit',
		'app.helpdesk_transaction',
		'app.helpdesk_transaction_type',
		'app.helpdesk_atm'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskSla = ClassRegistry::init('HelpdeskSla');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskSla);

		parent::tearDown();
	}

}
