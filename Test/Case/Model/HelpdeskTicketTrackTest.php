<?php
App::uses('HelpdeskTicketTrack', 'Model');

/**
 * HelpdeskTicketTrack Test Case
 *
 */
class HelpdeskTicketTrackTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_ticket_track'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskTicketTrack = ClassRegistry::init('HelpdeskTicketTrack');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskTicketTrack);

		parent::tearDown();
	}

}
