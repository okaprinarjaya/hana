<?php
App::uses('HelpdeskTransactionUnitPic', 'Model');

/**
 * HelpdeskTransactionUnitPic Test Case
 *
 */
class HelpdeskTransactionUnitPicTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_transaction_unit_pic',
		'app.helpdesk_transaction_unit',
		'app.helpdesk_transaction',
		'app.helpdesk_transaction_type',
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
		$this->HelpdeskTransactionUnitPic = ClassRegistry::init('HelpdeskTransactionUnitPic');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskTransactionUnitPic);

		parent::tearDown();
	}

}
