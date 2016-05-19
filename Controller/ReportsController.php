<?php
App::uses('AppController', 'Controller');

/**
 * ReportsController Controller
 *
 */
class ReportsController extends AppController {

	public $uses = array('HelpdeskTicket', 'HelpdeskCustomerQuestion', 'HelpdeskTransaction', 'ReportAwesome');
	public $components = array('Paginator');

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
		$q = $this->request->query;
		$qc = count($q);

		$month_from = $qc > 0 ? $q['start_month'] : 1;
		$month_to = $qc > 0 ? $q['end_month'] : 12;
		$year = $qc > 0 ? $q['year']['year'] : date("Y");

		App::uses('ConnectionManager', 'Model');

		$sql = "SELECT 
		month_series.the_month
		,IFNULL(j1.total_ticket, 0) AS total_ticket
		,IFNULL(j2.total_onprocess, 0) AS total_onprocess
		,IFNULL(j3.total_closed, 0) AS total_closed
		,IFNULL(j1.total_ticket, 0) - (IFNULL(j2.total_onprocess, 0) + IFNULL(j3.total_closed, 0)) AS total_open

		FROM (
			SELECT num AS the_month FROM nums WHERE num BETWEEN {$month_from} AND {$month_to}
		) month_series

		LEFT JOIN (
		    SELECT MONTH(created) AS j1_month, COUNT(*) AS total_ticket FROM helpdesk_tickets
		    WHERE MONTH(created) BETWEEN {$month_from} AND {$month_to}
		    AND YEAR(created) = {$year}
		    GROUP BY MONTH(created)

		) j1 ON month_series.the_month = j1.j1_month

		LEFT JOIN (
		    SELECT MONTH(created) AS j2_month, COUNT(*) AS total_onprocess FROM helpdesk_tickets
		    WHERE MONTH(created) BETWEEN {$month_from} AND {$month_to}
		    AND YEAR(created) = {$year}
		    AND ticket_status = 1
		    GROUP BY MONTH(created)

		) j2 ON month_series.the_month = j2.j2_month

		LEFT JOIN (
		    SELECT MONTH(created) AS j3_month, COUNT(*) AS total_closed FROM helpdesk_tickets
		    WHERE MONTH(created) BETWEEN {$month_from} AND {$month_to}
		    AND YEAR(created) = {$year}
		    AND ticket_status = 2
		    GROUP BY MONTH(created)

		) j3 ON month_series.the_month = j3.j3_month

		ORDER BY month_series.the_month ASC";

		$ds = ConnectionManager::getDataSource('default');
		$rows = $ds->query($sql);
		$months = months();

		$this->set(compact('rows', 'months', 'month_from', 'month_to', 'year'));
		$this->set('__js_append', array('highcharts', 'reports/reports_index'));
	}

	public function ticket_problem_alto_prima()
	{
		$q = $this->request->query;
		$qc = count($q);

		if ($qc > 0 && !empty($q['start_date']) && !empty($q['end_date'])) {

			$ids = $this->HelpdeskTicket->HelpdeskAtm->find('all', array(
				'fields' => array('HelpdeskAtm.id'),
				'conditions' => array('HelpdeskAtm.parent_id' => 2)
			));

			$inlist = array(2);
			foreach ($ids as $item) {
				array_push($inlist, $item['HelpdeskAtm']['id']);
			}

			$this->HelpdeskTicket->unbindModel(array(
				'hasMany' => array('HelpdeskTicketTrack')
			), false);

			$this->Paginator->settings = array(
				'conditions' => array(
					'HelpdeskAtm.id' => $inlist,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc'),
				'recursive' => 1
			);

			$tickets = $this->Paginator->paginate($this->HelpdeskTicket);

			$this->HelpdeskTicket->unbindModel(array(
				'belongsTo' => array(
					'HelpdeskTransactionUnit',
					'HelpdeskBank',
					'CreatedInfo',
					'ModifiedInfo'
				),
				'hasMany' => array('HelpdeskTicketTrack')
			), false);

			$open = $this->HelpdeskTicket->find('count', array(
				'conditions' => array(
					'HelpdeskTicket.ticket_status' => TICKET_STATUS_OPEN,
					'HelpdeskAtm.id' => $inlist,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
			));

			$onprocess = $this->HelpdeskTicket->find('count', array(
				'conditions' => array(
					'HelpdeskTicket.ticket_status' => TICKET_STATUS_PROCESS,
					'HelpdeskAtm.id' => $inlist,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
			));

			$closed = $this->HelpdeskTicket->find('count', array(
				'conditions' => array(
					'HelpdeskTicket.ticket_status' => TICKET_STATUS_CLOSE,
					'HelpdeskAtm.id' => $inlist,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
			));

			$ticket_statuses = ticket_statuses();

			$this->set(compact('tickets', 'open', 'onprocess', 'closed', 'ticket_statuses'));
		}
	}

	public function ticket_problem_hanabank()
	{
		$q = $this->request->query;
		$qc = count($q);

		if ($qc > 0 && !empty($q['start_date']) && !empty($q['end_date'])) {

			$this->HelpdeskTicket->unbindModel(array(
				'hasMany' => array('HelpdeskTicketTrack')
			), false);

			$this->Paginator->settings = array(
				'conditions' => array(
					'HelpdeskTicket.helpdesk_atm_id' => 1,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc'),
				'recursive' => 1
			);

			$tickets = $this->Paginator->paginate($this->HelpdeskTicket);

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
					'HelpdeskTicket.helpdesk_atm_id' => 1,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
			));

			$onprocess = $this->HelpdeskTicket->find('count', array(
				'conditions' => array(
					'HelpdeskTicket.ticket_status' => TICKET_STATUS_PROCESS,
					'HelpdeskTicket.helpdesk_atm_id' => 1,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
			));

			$closed = $this->HelpdeskTicket->find('count', array(
				'conditions' => array(
					'HelpdeskTicket.ticket_status' => TICKET_STATUS_CLOSE,
					'HelpdeskTicket.helpdesk_atm_id' => 1,
					'DATE(HelpdeskTicket.created) BETWEEN ? AND ?' => array($q['start_date'], $q['end_date'])
				),
				'order' => array('DATE(HelpdeskTicket.created)' => 'asc')
			));

			$ticket_statuses = ticket_statuses();

			$this->set(compact('tickets', 'open', 'onprocess', 'closed', 'ticket_statuses'));
		}
	}

	public function incoming_call()
	{
		$q = $this->request->query;
		$qc = count($q);
		$question_cond = array();
		$problem_cond = array();

		if ($qc > 0 && !empty($q['start_date']) && !empty($q['end_date'])) {
			$question_cond['DATE(HelpdeskCustomerQuestion.created) BETWEEN ? AND ?'] = array($q['start_date'], $q['end_date']);
			$problem_cond['DATE(HelpdeskTicket.created) BETWEEN ? AND ?'] = array($q['start_date'], $q['end_date']);
		
			$count_questions = $this->HelpdeskCustomerQuestion->find('count', array(
				'conditions' => $question_cond
			));

			$count_problems = $this->HelpdeskTicket->find('count', array(
				'conditions' => $problem_cond
			));

			App::uses('ConnectionManager', 'Model');

			$sql = "SELECT 
			data_merge.ISSUE_DATE
			,DATE_FORMAT(data_merge.ISSUE_DATE, '%d %M %Y') AS ISSUE_DATE_HUMAN
			,data_merge.phonenumber
			,data_merge.customer_name
			,data_merge.ISSUE_TYPE
			,data_merge.ISSUE
			,data_merge.ISSUE_ORDER 

			FROM (
				SELECT
				DATE(tix.created) AS ISSUE_DATE
				,tix.phonenumber
				,tix.customer_name
				,'PROBLEM' AS ISSUE_TYPE
				,trx_unit.unit_name AS ISSUE
				,1 AS ISSUE_ORDER 

				FROM helpdesk_tickets tix 
				LEFT JOIN helpdesk_transaction_units trx_unit ON tix.helpdesk_transaction_unit_id = trx_unit.id 

				WHERE DATE(tix.created) BETWEEN '{$q['start_date']}' AND '{$q['end_date']}' 

				UNION ALL 

				SELECT 
				DATE(cust_qs.created) AS ISSUE_DATE
				,cust_qs.phonenumber
				,cust_qs.customer_name
				,'QUESTION' AS ISSUE_TYPE
				,CONCAT('[', qs_type.type_name, ']', ' => ', cust_qs.note) AS ISSUE
				,2 AS ISSUE_ORDER 

				FROM helpdesk_customer_questions cust_qs 
				LEFT JOIN helpdesk_question_types qs_type ON cust_qs.helpdesk_question_type_id = qs_type.id 

				WHERE DATE(cust_qs.created) BETWEEN '{$q['start_date']}' AND '{$q['end_date']}'

			) data_merge 

			ORDER BY data_merge.ISSUE_DATE, data_merge.ISSUE_TYPE;";

			$ds = ConnectionManager::getDataSource('default');
			$rows = $ds->query($sql);

			$this->set(compact('rows', 'count_questions', 'count_problems'));
		}
	}

	public function faq()
	{
		$q = $this->request->query;
		$qc = count($q);

		$month_from = $qc > 0 ? $q['start_month'] : 1;
		$month_to = $qc > 0 ? $q['end_month'] : 12;
		$year = $qc > 0 ? $q['year']['year'] : date("Y");

		// Count all question by its question type
		$collection_of_counts = array();
		$info = array();

		$question_types = $this->HelpdeskCustomerQuestion->HelpdeskQuestionType->find('all', array(
			'fields' => array('HelpdeskQuestionType.id', 'HelpdeskQuestionType.type_name')
		));

		foreach ($question_types as $item) {
			$this->HelpdeskCustomerQuestion->recursive = -1;
			$count = $this->HelpdeskCustomerQuestion->find('count', array(
				'conditions' => array(
					'HelpdeskCustomerQuestion.helpdesk_question_type_id' => $item['HelpdeskQuestionType']['id'],
					'MONTH(HelpdeskCustomerQuestion.created) BETWEEN ? AND ?' => array($month_from, $month_to),
					'YEAR(HelpdeskCustomerQuestion.created)' => $year 
				)
			));

			$collection_of_counts[$item['HelpdeskQuestionType']['id']] = $count;
			$info[$item['HelpdeskQuestionType']['id']] = $item['HelpdeskQuestionType']['type_name'];
		}
		// --- End count all questions by its question type

		$sum = array_sum($collection_of_counts);
		$questions = array();

		if ($sum !== 0) {
			// Fetch all data based on highest value
			$highest_values = array_keys($collection_of_counts, max($collection_of_counts));

			$this->HelpdeskCustomerQuestion->recursive = 0;
			$questions = $this->HelpdeskCustomerQuestion->find('all', array(
				'conditions' => array(
					'HelpdeskCustomerQuestion.helpdesk_question_type_id' => $highest_values,
					'MONTH(HelpdeskCustomerQuestion.created) BETWEEN ? AND ?' => array($month_from, $month_to),
					'YEAR(HelpdeskCustomerQuestion.created)' => $year
				),
			));
		}

		$months = months();

		$this->set(compact('questions', 'collection_of_counts', 'info', 'months', 'month_from', 'month_to', 'year', 'highest_values'));
	}

	public function frequent_problems()
	{
		App::uses('ConnectionManager', 'Model');

		$q = $this->request->query;
		$qc = count($q);
		$rows = null;

		if ($qc > 0 && !empty($q['start_date']) && !empty($q['end_date'])) {

			$sql = "SELECT 
			pc.helpdesk_transaction_id
			,pc.helpdesk_transaction_type_id
			,pc.helpdesk_transaction_unit_id
			,trx_type.type_name
			,trx_unit.unit_name
			,SUM(pc.counter) AS sum_count 

			FROM helpdesk_problems_counter pc 
			LEFT JOIN helpdesk_transaction_types trx_type ON pc.helpdesk_transaction_type_id = trx_type.id 
			LEFT JOIN helpdesk_transaction_units trx_unit ON pc.helpdesk_transaction_unit_id = trx_unit.id 

			WHERE pc.created BETWEEN '{$q['start_date']}' AND '{$q['end_date']}' 

			GROUP BY 
			pc.helpdesk_transaction_id
			,pc.helpdesk_transaction_type_id
			,pc.helpdesk_transaction_unit_id";

			$ds = ConnectionManager::getDataSource('default');
			$rows = $ds->query($sql);
			$ds = null;
		}

		$trxs = $this->HelpdeskTransaction->find('all');
		$trxs_report_container = array();

		foreach ($trxs as $trx_item) {
			$trxs_report_container[$trx_item['HelpdeskTransaction']['id']] = array(
				'trx_counter' => 0,
				'trx_name' => $trx_item['HelpdeskTransaction']['transaction_name'],
				'trx_unit_items' => array()
			);
		}

		if ($rows != null) {
			foreach ($rows as $trx_unit_item) {
				$trxs_report_container[$trx_unit_item['pc']['helpdesk_transaction_id']]['trx_counter'] += $trx_unit_item[0]['sum_count'];
				$trxs_report_container[$trx_unit_item['pc']['helpdesk_transaction_id']]['trx_unit_items'][] = array(
					'trx_type' => $trx_unit_item['trx_type']['type_name'],
					'trx_unit_name' => $trx_unit_item['trx_unit']['unit_name'],
					'trx_unit_counter' => $trx_unit_item[0]['sum_count']
				);
			}
		}

		$this->set('trxs_report_container', $trxs_report_container);
	}

	public function oprek()
	{		
		$sql = "SELECT 
		month_series.the_month
		,IFNULL(j1.total_ticket, 0) AS total_ticket
		,IFNULL(j2.total_onprocess, 0) AS total_onprocess
		,IFNULL(j3.total_closed, 0) AS total_closed
		,IFNULL(j1.total_ticket, 0) - (IFNULL(j2.total_onprocess, 0) + IFNULL(j3.total_closed, 0)) AS total_open

		FROM (
			SELECT num AS the_month FROM nums WHERE num BETWEEN 1 AND 12
		) month_series

		LEFT JOIN (
		    SELECT MONTH(created) AS j1_month, COUNT(*) AS total_ticket FROM helpdesk_tickets
		    WHERE MONTH(created) BETWEEN 1 AND 12
		    AND YEAR(created) = 2014
		    GROUP BY MONTH(created)

		) j1 ON month_series.the_month = j1.j1_month

		LEFT JOIN (
		    SELECT MONTH(created) AS j2_month, COUNT(*) AS total_onprocess FROM helpdesk_tickets
		    WHERE MONTH(created) BETWEEN 1 AND 12
		    AND YEAR(created) = 2014
		    AND ticket_status = 1
		    GROUP BY MONTH(created)

		) j2 ON month_series.the_month = j2.j2_month

		LEFT JOIN (
		    SELECT MONTH(created) AS j3_month, COUNT(*) AS total_closed FROM helpdesk_tickets
		    WHERE MONTH(created) BETWEEN 1 AND 12
		    AND YEAR(created) = 2014
		    AND ticket_status = 2
		    GROUP BY MONTH(created)

		) j3 ON month_series.the_month = j3.j3_month

		ORDER BY month_series.the_month ASC";

		$this->Paginator->settings = array(
			'conditions' => array(
				'query' => $sql
			),
			'limit' => 2
		);

		$this->set('opreks', $this->Paginator->paginate($this->ReportAwesome));
	}

}