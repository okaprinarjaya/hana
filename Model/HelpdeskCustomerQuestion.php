<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskCustomerQuestion Model
 *
 * @property HelpdeskQuestionType $HelpdeskQuestionType
 */
class HelpdeskCustomerQuestion extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'phonenumber' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'HelpdeskQuestionType' => array(
			'className' => 'HelpdeskQuestionType',
			'foreignKey' => 'helpdesk_question_type_id',
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

}
