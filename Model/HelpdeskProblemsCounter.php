<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskProblemsCounter Model
 *
 * @property HelpdeskTransaction $HelpdeskTransaction
 * @property HelpdeskTransactionType $HelpdeskTransactionType
 * @property HelpdeskTransactionUnit $HelpdeskTransactionUnit
 */
class HelpdeskProblemsCounter extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'helpdesk_problems_counter';


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'HelpdeskTransaction' => array(
			'className' => 'HelpdeskTransaction',
			'foreignKey' => 'helpdesk_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'HelpdeskTransactionType' => array(
			'className' => 'HelpdeskTransactionType',
			'foreignKey' => 'helpdesk_transaction_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'HelpdeskTransactionUnit' => array(
			'className' => 'HelpdeskTransactionUnit',
			'foreignKey' => 'helpdesk_transaction_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
