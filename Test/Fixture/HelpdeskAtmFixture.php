<?php
/**
 * HelpdeskAtmFixture
 *
 */
class HelpdeskAtmFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'helpdesk_atm';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'atm_location' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'atm_location' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-03-18 09:34:10',
			'modified' => '2014-03-18 09:34:10'
		),
	);

}
