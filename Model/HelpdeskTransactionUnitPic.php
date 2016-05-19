<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskTransactionUnitPic Model
 *
 * @property HelpdeskTransactionUnit $HelpdeskTransactionUnit
 * @property User $User
 */
class HelpdeskTransactionUnitPic extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'helpdesk_transaction_unit_pic';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
