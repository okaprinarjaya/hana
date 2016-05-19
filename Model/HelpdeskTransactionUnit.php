<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskTransactionUnit Model
 *
 * @property HelpdeskTransaction $HelpdeskTransaction
 * @property HelpdeskTransactionType $HelpdeskTransactionType
 * @property HelpdeskSla $HelpdeskSla
 * @property HelpdeskTicket $HelpdeskTicket
 */
class HelpdeskTransactionUnit extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'unit_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'helpdesk_transaction_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'helpdesk_transaction_type_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'unit_name' => array(
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
		)
	);

	public $hasMany = array(
		'HelpdeskPIC' => array(
			'className' => 'HelpdeskTransactionUnitPic',
			'foreignKey' => 'helpdesk_transaction_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function all_transaction_units()
	{
		$f = array();
		$trxs = $this->HelpdeskTransaction->find('all');
		
		foreach ($trxs as $trx_item) {
			$f[$trx_item['HelpdeskTransaction']['id']] = array(
				'props' => $trx_item,
				'items' => array()
			);
		}

		$trx_units = $this->find('all');
		foreach ($trx_units as $trx_unit_item) {
			$f[$trx_unit_item['HelpdeskTransactionUnit']['helpdesk_transaction_id']]['items'][$trx_unit_item['HelpdeskTransactionUnit']['helpdesk_transaction_type_id']]['props'] = $trx_unit_item['HelpdeskTransactionType'];
			$f[$trx_unit_item['HelpdeskTransactionUnit']['helpdesk_transaction_id']]['items'][$trx_unit_item['HelpdeskTransactionUnit']['helpdesk_transaction_type_id']]['items'][] = $trx_unit_item['HelpdeskTransactionUnit'];
		}

		return $f;
	}
}
