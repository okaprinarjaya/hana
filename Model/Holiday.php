<?php
App::uses('AppModel', 'Model');
/**
 * Holiday Model
 *
 */
class Holiday extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'holiday_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'holiday_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'holiday_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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

	public function get_holidays_by_date_range($start_date, $finish_date)
	{
		$dates = $this->find('all', array(
			'fields' => array('Holiday.holiday_date'),
			'conditions' => array(
				'Holiday.holiday_date >= ? AND Holiday.holiday_date <= ?' => array($start_date, $finish_date)
			)
		));

		$holidays = array();
		foreach ($dates as $item) {
			array_push($holidays, $item['Holiday']['holiday_date']);
		}

		return $holidays;
	}
}
