<?php
App::uses('AppModel', 'Model');
/**
 * HelpdeskSla Model
 *
 * @property HelpdeskTransactionUnit $HelpdeskTransactionUnit
 * @property HelpdeskAtm $HelpdeskAtm
 */
class HelpdeskSla extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'helpdesk_sla';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'sla_code';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'sla_code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sla_days' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		)
	);
}
