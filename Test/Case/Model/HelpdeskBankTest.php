<?php
App::uses('HelpdeskBank', 'Model');

/**
 * HelpdeskBank Test Case
 *
 */
class HelpdeskBankTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_bank'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskBank = ClassRegistry::init('HelpdeskBank');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskBank);

		parent::tearDown();
	}

}
