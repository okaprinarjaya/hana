<?php
App::uses('AppModel', 'Model');

/**
 * BaseUpload Model
 *
 */
class BaseUpload extends AppModel {

	public $actsAs = array('Media.Media' => array('path' => '/img/uploads/base_upload/%y-%m/%f'));

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'base_uploads';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'base_upload_title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'base_upload_title' => array(
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
