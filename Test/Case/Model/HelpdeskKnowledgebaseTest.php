<?php
App::uses('HelpdeskKnowledgebase', 'Model');

/**
 * HelpdeskKnowledgebase Test Case
 *
 */
class HelpdeskKnowledgebaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_knowledgebase',
		'app.helpdesk_knowledge_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskKnowledgebase = ClassRegistry::init('HelpdeskKnowledgebase');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskKnowledgebase);

		parent::tearDown();
	}

}
