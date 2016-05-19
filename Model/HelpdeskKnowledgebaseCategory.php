<?php
App::uses('AppModel', 'Model');

/**
 * HelpdeskKnowledgebaseCategory Model
 *
 * @property HelpdeskKnowledgebase $HelpdeskKnowledgebase
 */
class HelpdeskKnowledgebaseCategory extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'helpdesk_knowledgebase_categories';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'category_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'category_name' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'HelpdeskKnowledgebase' => array(
			'className' => 'HelpdeskKnowledgebase',
			'foreignKey' => 'helpdesk_knowledgebase_category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
