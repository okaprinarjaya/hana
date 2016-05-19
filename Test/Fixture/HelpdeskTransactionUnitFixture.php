<?php
/**
 * HelpdeskTransactionUnitFixture
 *
 */
class HelpdeskTransactionUnitFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'helpdesk_transaction_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'helpdesk_transaction_type_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'unit_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'modified_by' => array('type' => 'integer', 'null' => true, 'default' => null),
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
			'unit_name' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-03-18 09:02:36',
			'modified' => '2014-03-18 09:02:36',
			'created_by' => 1,
			'modified_by' => 1
		),
	);

}
