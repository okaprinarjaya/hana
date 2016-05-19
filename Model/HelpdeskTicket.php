<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskTicket Model
 *
 * @property HelpdeskTransactionUnit $HelpdeskTransactionUnit
 * @property HelpdeskAtm $HelpdeskAtm
 * @property HelpdeskBank $HelpdeskBank
 */
class HelpdeskTicket extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'ticket_number';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ticket_number' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'customer_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'customer_email' => array(
			'validEmail' => array(
				'rule' => array('email'),
				'message' => 'Please fill a valid email. Not valid email format'
			),
		),
		'helpdesk_transaction_unit_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'helpdesk_atm_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'priority' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'HelpdeskTransactionUnit' => array(
			'className' => 'HelpdeskTransactionUnit',
			'foreignKey' => 'helpdesk_transaction_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'HelpdeskAtm' => array(
			'className' => 'HelpdeskAtm',
			'foreignKey' => 'helpdesk_atm_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'HelpdeskBank' => array(
			'className' => 'HelpdeskBank',
			'foreignKey' => 'helpdesk_bank_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CreatedInfo' => array(
			'className' => 'User',
			'foreignKey' => 'created_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ModifiedInfo' => array(
			'className' => 'User',
			'foreignKey' => 'modified_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'HelpdeskTicketTrack' => array(
			'className' => 'HelpdeskTicketTrack',
			'foreignKey' => 'helpdesk_ticket_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
