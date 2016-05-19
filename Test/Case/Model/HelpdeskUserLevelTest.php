<?php
App::uses('HelpdeskUserLevel', 'Model');

/**
 * HelpdeskUserLevel Test Case
 *
 */
class HelpdeskUserLevelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_user_level'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskUserLevel = ClassRegistry::init('HelpdeskUserLevel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskUserLevel);

		parent::tearDown();
	}

}
