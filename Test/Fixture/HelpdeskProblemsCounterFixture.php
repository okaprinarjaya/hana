<?php
/**
 * HelpdeskProblemsCounterFixture
 *
 */
class HelpdeskProblemsCounterFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'helpdesk_problems_counter';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'helpdesk_transaction_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'helpdesk_transaction_type_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'helpdesk_transaction_unit_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'counter' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'helpdesk_transaction_id' => 1,
			'helpdesk_transaction_type_id' => 1,
			'helpdesk_transaction_unit_id' => 1,
			'counter' => 1,
			'created' => '2014-04-26'
		),
	);

}
