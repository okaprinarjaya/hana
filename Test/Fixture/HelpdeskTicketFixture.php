<?php
/**
 * HelpdeskTicketFixture
 *
 */
class HelpdeskTicketFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ticket_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 8, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'customer_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'customer_email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'account_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'atm_card_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'helpdesk_transaction_unit_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'helpdesk_atm_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'helpdesk_bank_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'problem_datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'money_amount' => array('type' => 'float', 'null' => true, 'default' => null),
		'money_currency' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'problem_desc' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'ticket_number' => 'Lorem ',
			'customer_name' => 'Lorem ipsum dolor sit amet',
			'customer_email' => 'Lorem ipsum dolor sit amet',
			'account_number' => 'Lorem ipsum dolor sit amet',
			'atm_card_number' => 'Lorem ipsum dolor sit amet',
			'helpdesk_transaction_unit_id' => 1,
			'helpdesk_atm_id' => 1,
			'helpdesk_bank_id' => 1,
			'problem_datetime' => '2014-03-19 08:24:40',
			'money_amount' => 1,
			'money_currency' => 1,
			'priority' => 1,
			'problem_desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2014-03-19 08:24:40',
			'modified' => '2014-03-19 08:24:40',
			'created_by' => 1,
			'modified_by' => 1
		),
	);

}
