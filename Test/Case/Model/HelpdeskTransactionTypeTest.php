<?php
App::uses('HelpdeskTransactionType', 'Model');

/**
 * HelpdeskTransactionType Test Case
 *
 */
class HelpdeskTransactionTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_transaction_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskTransactionType = ClassRegistry::init('HelpdeskTransactionType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskTransactionType);

		parent::tearDown();
	}

}
