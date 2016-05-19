<?php
App::uses('AppController', 'Controller');

/**
 * DashboardController Controller
 *
 * @property Dashboard $Dashboard
 */
class DashboardController extends AppController {

	public $uses = array('HelpdeskTicket');

/**
 * Auth methods
 *
 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function isAuthorized($user)
	{
		return parent::isAuthorized($user);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// Count tickets by ticket status
		$this->HelpdeskTicket->unbindModel(array(
			'belongsTo' => array(
				'HelpdeskTransactionUnit',
				'HelpdeskBank',
				'HelpdeskAtm',
				'CreatedInfo',
				'ModifiedInfo'
			),
			'hasMany' => array('HelpdeskTicketTrack')
		), false);

		$open = $this->HelpdeskTicket->find('count', array(
			'conditions' => array(
				'HelpdeskTicket.ticket_status' => TICKET_STATUS_OPEN,
			),
			'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
		));

		$onprocess = $this->HelpdeskTicket->find('count', array(
			'conditions' => array(
				'HelpdeskTicket.ticket_status' => TICKET_STATUS_PROCESS,
			),
			'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
		));

		$closed = $this->HelpdeskTicket->find('count', array(
			'conditions' => array(
				'HelpdeskTicket.ticket_status' => TICKET_STATUS_CLOSE,
			),
			'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
		));

		$this->set(compact('open', 'onprocess', 'closed'));
		$this->set('__js_append', array('highcharts', 'dashboard/dashboard_index'));
	}

}