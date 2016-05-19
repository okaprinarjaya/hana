<?php
App::uses('HelpdeskAtm', 'Model');

/**
 * HelpdeskAtm Test Case
 *
 */
class HelpdeskAtmTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_atm'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskAtm = ClassRegistry::init('HelpdeskAtm');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskAtm);

		parent::tearDown();
	}

}
