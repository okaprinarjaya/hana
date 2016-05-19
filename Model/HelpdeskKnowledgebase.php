<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskKnowledgebase Model
 *
 * @property HelpdeskKnowledgeCategory $HelpdeskKnowledgeCategory
 */
class HelpdeskKnowledgebase extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'helpdesk_knowledgebase';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'HelpdeskKnowledgebaseCategory' => array(
			'className' => 'HelpdeskKnowledgebaseCategory',
			'foreignKey' => 'helpdesk_knowledgebase_category_id',
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
		'HelpdeskKnowledgebaseFile' => array(
			'className' => 'HelpdeskKnowledgebaseFile',
			'foreignKey' => 'helpdesk_knowledgebase_id'
		)
	);
}
