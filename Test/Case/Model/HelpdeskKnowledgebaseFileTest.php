<?php
App::uses('HelpdeskKnowledgebaseFile', 'Model');

/**
 * HelpdeskKnowledgebaseFile Test Case
 *
 */
class HelpdeskKnowledgebaseFileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_knowledgebase_file'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskKnowledgebaseFile = ClassRegistry::init('HelpdeskKnowledgebaseFile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskKnowledgebaseFile);

		parent::tearDown();
	}

}
