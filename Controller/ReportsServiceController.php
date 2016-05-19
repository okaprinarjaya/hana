<?php
App::uses('AppController', 'Controller');

/**
 * ReportsServiceController Controller
 *
 */
class ReportsServiceController extends AppController
{
	public $uses = null;
	public $components = array('RequestHandler');

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

	private function __init()
	{
		Configure::write ('debug', 0);
		$this->autoRender = false;
		$this->disableCache();
	}

	public function ticket_transactions()
	{
		$this->__init();

		$q = $this->request->query;
		$qc = count($q);

		$month_from = $qc > 0 ? $q['start_month'] : 1;
		$month_to = $qc > 0 ? $q['end_month'] : 12;
		$year = $qc > 0 ? $q['year'] : date("Y");

		App::uses('ConnectionManager', 'Model');

		$sql = "
		SELECT 
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

		ORDER BY month_series.the_month ASC
		";

		$ds = ConnectionManager::getDataSource('default');
		$rows = $ds->query($sql);
		$months = months_short();
		$data = array(
			array(),
			array('name' => 'OPEN', 'data' => array()),
			array('name' => 'ON PROCESS', 'data' => array()),
			array('name' => 'CLOSED', 'data' => array())
		);

		foreach ($rows as $item) {
			array_push($data[0], $months[$item['month_series']['the_month']]);
			array_push($data[1]['data'], (int) $item[0]['total_open']);
			array_push($data[2]['data'], (int) $item[0]['total_onprocess']);
			array_push($data[3]['data'], (int) $item[0]['total_closed']);
		}

		$this->response->type(array('json' => 'application/json'));
		$this->response->type('json');

		echo json_encode(array('content' => $data));
	}
}