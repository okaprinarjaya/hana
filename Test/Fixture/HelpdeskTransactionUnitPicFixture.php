<?php
/**
 * HelpdeskTransactionUnitPicFixture
 *
 */
class HelpdeskTransactionUnitPicFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'helpdesk_transaction_unit_pic';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'helpdesk_transaction_unit_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'helpdesk_transaction_unit_id'), 'unique' => 1)
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
			'user_id' => 1,
			'created' => '2014-03-25 09:51:15',
			'modified' => '2014-03-25 09:51:15'
		),
	);

}
