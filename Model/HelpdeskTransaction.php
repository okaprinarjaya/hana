<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskTransaction Model
 *
 */
class HelpdeskTransaction extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'transaction_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'transaction_name' => array(
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
}
