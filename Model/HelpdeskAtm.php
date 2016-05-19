<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskAtm Model
 *
 */
class HelpdeskAtm extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'helpdesk_atm';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'atm_location';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'atm_location' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
