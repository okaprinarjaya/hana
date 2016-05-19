<?php
App::uses('HelpdeskKnowledgebaseCategory', 'Model');

/**
 * HelpdeskKnowledgebaseCategory Test Case
 *
 */
class HelpdeskKnowledgebaseCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.helpdesk_knowledgebase_category',
		'app.helpdesk_knowledgebase'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HelpdeskKnowledgebaseCategory = ClassRegistry::init('HelpdeskKnowledgebaseCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HelpdeskKnowledgebaseCategory);

		parent::tearDown();
	}

}
