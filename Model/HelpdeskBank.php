<?php
App::uses('AppModel', 'Model');
/**
 * HelpdeskBank Model
 *
 */
class HelpdeskBank extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'bank_location';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'bank_location' => array(
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
