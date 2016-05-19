<?php
/**
 * HelpdeskTicketTrackFixture
 *
 */
class HelpdeskTicketTrackFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'helpdesk_ticket_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ticket_status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'helpdesk_ticket_id'), 'unique' => 1)
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
			'helpdesk_ticket_id' => 1,
			'ticket_status' => 1,
			'priority' => 1,
			'created' => '2014-03-20 10:55:35',
			'created_by' => 1
		),
	);

}
