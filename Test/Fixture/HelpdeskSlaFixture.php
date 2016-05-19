<?php
/**
 * HelpdeskSlaFixture
 *
 */
class HelpdeskSlaFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'helpdesk_sla';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'helpdesk_transaction_unit_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'helpdesk_atm_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'sla_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 8, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sla_days' => array('type' => 'integer', 'null' => false, 'default' => null),
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
			'helpdesk_transaction_unit_id' => 1,
			'helpdesk_atm_id' => 1,
			'sla_code' => 'Lorem ',
			'sla_days' => 1,
			'created' => '2014-03-20 15:45:03',
			'modified' => '2014-03-20 15:45:03',
			'created_by' => 1,
			'modified_by' => 1
		),
	);

}
