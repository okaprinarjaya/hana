<?php
App::uses('HelpdeskTransaction', 'Model');

/**
 * HelpdeskTransaction Test Case
 *
 */
class HelpdeskTransactionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_transaction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskTransaction = ClassRegistry::init('HelpdeskTransaction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskTransaction);

		parent::tearDown();
	}

}
