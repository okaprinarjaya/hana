<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskTickets Controller
 *
 */
class HelpdeskTicketsController extends AppController {

	public $uses = array(
		'HelpdeskTicket',
		'HelpdeskTransaction',
		'HelpdeskTransactionType',
		'HelpdeskSla',
		'HelpdeskProblemsCounter',
		'Holiday',
		'User'
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler', 'Paginator');

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
		$this->autoRender = false;
		
		// Construct conditions
		$conditions = array();

		if (isset($this->request->query['date_from']) && !empty($this->request->query['date_from'])) {
			$conditions['DATE(HelpdeskTicket.created) BETWEEN ? AND ?'] = array($this->request->query['date_from'], $this->request->query['date_to']);
		}

		if (isset($this->request->query['ticket_status']) && $this->request->query['ticket_status'] !== 'null') {
			$conditions['HelpdeskTicket.ticket_status'] = $this->request->query['ticket_status'];
		}

		if (isset($this->request->query['ticket_priority']) && $this->request->query['ticket_priority'] !== 'null') {
			$conditions['HelpdeskTicket.priority'] = $this->request->query['ticket_priority'];
		}

		if (isset($this->request->query['sort_by_status']) && !empty($this->request->query['sort_by_status'])) {
			$statuses = array('open' => TICKET_STATUS_OPEN, 'onprocess' => TICKET_STATUS_PROCESS, 'closed' => TICKET_STATUS_CLOSE);
			$conditions['HelpdeskTicket.ticket_status'] = $statuses[$this->request->query['sort_by_status']];
		}

		if (isset($this->request->query['ticket_number']) && !empty($this->request->query['ticket_number'])) {
			$statuses = array('open' => TICKET_STATUS_OPEN, 'onprocess' => TICKET_STATUS_PROCESS, 'closed' => TICKET_STATUS_CLOSE);
			$conditions['HelpdeskTicket.ticket_number'] = $this->request->query['ticket_number'];
		}

		$this->HelpdeskTicket->virtualFields['OVERDUE_LEVEL1'] = "IF(CURRENT_DATE() <= sla_date, IF(DATEDIFF(sla_date, CURRENT_DATE()) >= 0 AND DATEDIFF(sla_date, CURRENT_DATE()) <= 3, 'SOON', 'NO'), 'YES')";
		$this->HelpdeskTicket->virtualFields['OVERDUE_LEVEL2'] = "IF(CURRENT_DATE() <= limit_date2, IF(DATEDIFF(limit_date2, CURRENT_DATE()) >= 0 AND DATEDIFF(limit_date2, CURRENT_DATE()) <= 2, 'SOON', 'NO'), 'YES')";
		$this->HelpdeskTicket->virtualFields['OVERDUE_LEVEL3'] = "IF(CURRENT_DATE() <= limit_date3, IF(DATEDIFF(limit_date3, CURRENT_DATE()) >= 0 AND DATEDIFF(limit_date3, CURRENT_DATE()) <= 2, 'SOON', 'NO'), 'YES')";

		$this->HelpdeskTicket->recursive = 0;
		$this->Paginator->settings = array(
			'conditions' => $conditions,
			'order' => array('HelpdeskTicket.created' => 'DESC')
		);

		$ticket_statuses = ticket_statuses();
		$ticket_statuses['null'] = '---';

		$ticket_priorities = priorities();
		$ticket_priorities['null'] = '---';

		$user_levels = user_levels();
		$currencies = currencies();

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

		$this->HelpdeskTicket->bindModel(array(
			'belongsTo' => array(
				'HelpdeskTransactionUnit'
		)));

		$this->set('helpdeskTickets', $this->Paginator->paginate());

		$this->set(compact(
			'ticket_statuses',
			'ticket_priorities',
			'user_levels',
			'currencies',
			'open',
			'onprocess',
			'closed'
		));

		$this->set('__js_append', array('helpdesk_tickets/helpdesk_tickets_index'));

		if ($this->Auth->user('role') == 3) {
			$this->render('index_op');
		} else {
			$this->render('index');
		}
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['HelpdeskTicket']['created_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskTicket']['modified_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskTicket']['problem_datetime'] = $this->request->data['Foo']['problem_date'].' '.$this->request->data['Foo']['problem_time']['hour'].':'.$this->request->data['Foo']['problem_time']['min'].':00';
			$date_now = date('Y-m-d');

			// Generate ticket's number
			App::uses('ConnectionManager', 'Model');
			$db = ConnectionManager::getDataSource('default');

			$conn = new PDO('mysql:host=localhost;dbname=helpdesk', 'apps', '34erdfcv', array(PDO::ATTR_PERSISTENT => false));
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$conn->exec('LOCK TABLES helpdesk_tickets READ;');
			$conn->exec('LOCK TABLES helpdesk_tickets WRITE;');

			$str_query = "SELECT COUNT(id) AS total_ticket FROM helpdesk_tickets WHERE DATE(created) = '{$date_now}'";

			$query = $conn->query($str_query);
			$data = $query->fetch(PDO::FETCH_ASSOC);

			$conn->exec('UNLOCK TABLES;');
			$conn = null;  // close connection manually. because it is a persistent connection

			$next_number = $data['total_ticket']+1;
			$ticket_number = 'HAN'.date('ymd').$next_number;
			// --- End generate ticket's number

			$date2 = date('Y-m-d', strtotime("{$this->request->data['HelpdeskTicket']['sla_date']} +1 weekdays"));
			$date3 = date('Y-m-d', strtotime("{$date2} +1 weekdays"));
			$holidays = $this->Holiday->get_holidays_by_date_range($this->request->data['HelpdeskTicket']['sla_date'], $date3);
			$limit_date2 = getWDays($this->request->data['HelpdeskTicket']['sla_date'], $holidays, 1);
			$limit_date3 = getWDays($date2, $holidays, 1);

			$this->request->data['HelpdeskTicket']['ticket_number'] = $ticket_number;
			$this->request->data['HelpdeskTicket']['limit_date2'] = $limit_date2;
			$this->request->data['HelpdeskTicket']['limit_date3'] = $limit_date3;
			$this->request->data['HelpdeskTicket']['helpdesk_user_level_id'] = USER_LEVEL_1;

			$this->HelpdeskTicket->create();
			if ($this->HelpdeskTicket->save($this->request->data)) {

				$lastID = $this->HelpdeskTicket->getInsertID();

				/* Start count problem */

				$status_process = false;

				$problem = $this->HelpdeskProblemsCounter->find('first', array(
					'conditions' => array(
						'HelpdeskProblemsCounter.helpdesk_transaction_id' => $this->request->data['Foo']['helpdesk_transaction_id'],
						'HelpdeskProblemsCounter.helpdesk_transaction_type_id' => $this->request->data['Foo']['helpdesk_transaction_type_id'],
						'HelpdeskProblemsCounter.helpdesk_transaction_unit_id' => $this->request->data['HelpdeskTicket']['helpdesk_transaction_unit_id'],
						'HelpdeskProblemsCounter.created' => $date_now
					)
				));

				if ($problem == null) {
					$this->HelpdeskProblemsCounter->create();
					$status_process = $this->HelpdeskProblemsCounter->save(array(
						'HelpdeskProblemsCounter' => array(
							'helpdesk_transaction_id' => $this->request->data['Foo']['helpdesk_transaction_id'],
							'helpdesk_transaction_type_id' => $this->request->data['Foo']['helpdesk_transaction_type_id'],
							'helpdesk_transaction_unit_id' => $this->request->data['HelpdeskTicket']['helpdesk_transaction_unit_id'],
							'counter' => 1,
							'created' => $date_now
						)
					));

				} else {
					$data_update_counter = array(
						'HelpdeskProblemsCounter.counter' => $problem['HelpdeskProblemsCounter']['counter'] + 1
					);

					$status_process = $this->HelpdeskProblemsCounter->updateAll($data_update_counter, array(
						'HelpdeskProblemsCounter.helpdesk_transaction_id' => $problem['HelpdeskProblemsCounter']['helpdesk_transaction_id'],
						'HelpdeskProblemsCounter.helpdesk_transaction_type_id' => $problem['HelpdeskProblemsCounter']['helpdesk_transaction_type_id'],
						'HelpdeskProblemsCounter.helpdesk_transaction_unit_id' => $problem['HelpdeskProblemsCounter']['helpdesk_transaction_unit_id'],
						'HelpdeskProblemsCounter.created' => $date_now
					));
				}
				

				/* -- End count problems */

				/* Send email */

				if ($status_process) {
					App::uses('CakeEmail', 'Network/Email');

					$tix = $this->HelpdeskTicket->find('first', array('conditions' => array('HelpdeskTicket.id' => $lastID)));
					$pics_level1 = $this->User->find('all', array(
						'conditions' => array(
							'User.user_level_id' => 1,
							'User.role' => 2
						)
					));

					$Email = new CakeEmail('smtp');

					// Send email to all PIC level 1
					$Email->template('default', 'default');
					$Email->emailFormat('html');

					foreach ($pics_level1 as $pic) {
						$Email->viewVars(array('tix' => $tix, 'pic' => $pic));
						$Email->to($pic['User']['email']);
						$Email->subject('[Call Hana Bank] Confirmation: New ticket created');
						$Email->send();
					}

					// Send email to customer
					if (!empty($this->request->data['HelpdeskTicket']['customer_email'])) {
						$Email->template('customer', 'default');
						$Email->viewVars(array(
							'customer_name' => $this->request->data['HelpdeskTicket']['customer_name'],
							'whatever' => $this->request->data['HelpdeskTicket']['whatever'],
							'ticket_number' => $this->request->data['HelpdeskTicket']['ticket_number'],
							'whatever_list' => array(
								'A' => 'Mr',
								'B' => 'Ms',
								'C' => 'Mrs'
							)
						));
						$Email->to($this->request->data['HelpdeskTicket']['customer_email']);
						$Email->subject('[Call Hana Bank] Ticket information');
						$Email->send();
					}
				}

				/* End send email */

				$this->Session->setFlash(__('The helpdesk ticket has been saved.'));
				return $this->redirect(array('action' => 'index'));

			} else {
				$this->Session->setFlash(__('The helpdesk ticket could not be saved. Please, try again.'));
			}
		}

		$helpdeskTransactions = $this->HelpdeskTransaction->find('list');
		$helpdeskTransactions[0] = '---';
		$helpdeskTransactionTypes = $this->HelpdeskTransactionType->find('list');
		$helpdeskTransactionTypes[0] = '---';

		if (isset($this->request->data['HelpdeskTicket'])) {

			$helpdeskTransactionUnits = $this->HelpdeskTicket->HelpdeskTransactionUnit->find('list', array(
				'conditions' => array(
					'HelpdeskTransactionUnit.helpdesk_transaction_id' => $this->request->data['Foo']['helpdesk_transaction_id'],
					'HelpdeskTransactionUnit.helpdesk_transaction_type_id' => $this->request->data['Foo']['helpdesk_transaction_type_id']
				)
			));

			/*
			 * **********
			 * Get ATMs
			 * **********
			 */
			$slas = $this->HelpdeskSla->find('all', array(
				'conditions' => array(
					'HelpdeskSla.helpdesk_transaction_unit_id' => $this->request->data['HelpdeskTicket']['helpdesk_transaction_unit_id']
				)
			));

			$slas_count = count($slas);
			$helpdeskAtms = null;

			if ($slas_count === 1) {
				if ($slas[0]['HelpdeskSla']['helpdesk_atm_id'] == 0) {
					$helpdeskAtms = array(array('HelpdeskAtm' => array('id' => 0, 'atm_location' => '---'), 'children' => array()));

				} else {
					$helpdeskAtms = $this->HelpdeskSla->HelpdeskAtm->find('threaded', array(
						'conditions' => array(
							'OR' => array(
								'HelpdeskAtm.parent_id' => $slas[0]['HelpdeskSla']['helpdesk_atm_id'],
								'HelpdeskAtm.id' => $slas[0]['HelpdeskSla']['helpdesk_atm_id']
							)
						)
					));
				}

			} else if ($slas_count === 2) {
				$helpdeskAtms = $this->HelpdeskSla->HelpdeskAtm->find('threaded');
			}
			// --- End get ATMs

			$this->set(compact(
				'helpdeskTransactions',
				'helpdeskTransactionTypes',
				'helpdeskAtms',
				'helpdeskTransactionUnits'
			));

		} else {
			$this->set(compact(
				'helpdeskTransactions',
				'helpdeskTransactionTypes'
			));
		}

		$this->set('__js_append', array('helpdesk_tickets/helpdesk_tickets_add_edit'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskTicket->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk ticket'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['HelpdeskTicket']['modified_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskTicket']['problem_datetime'] = $this->request->data['Foo']['problem_date'].' '.$this->request->data['Foo']['problem_time']['hour'].':'.$this->request->data['Foo']['problem_time']['min'].':00';

			// Create a backup for current edited row
			$options = array('conditions' => array('HelpdeskTicket.' . $this->HelpdeskTicket->primaryKey => $id));
			$backup = $this->HelpdeskTicket->find('first', $options);

			$this->HelpdeskTicket->HelpdeskTicketTrack->create();
			$create_backup = $this->HelpdeskTicket->HelpdeskTicketTrack->save(array(
				'HelpdeskTicketTrack' => array(
					'helpdesk_ticket_id' => $backup['HelpdeskTicket']['id'],
					'customer_name' => $backup['HelpdeskTicket']['customer_name'],
					'customer_email' => $backup['HelpdeskTicket']['customer_email'],
					'account_number' => $backup['HelpdeskTicket']['account_number'],
					'helpdesk_transaction_unit_id' => $backup['HelpdeskTicket']['helpdesk_transaction_unit_id'],
					'helpdesk_atm_id' => $backup['HelpdeskTicket']['helpdesk_atm_id'],
					'helpdesk_bank_id' => $backup['HelpdeskTicket']['helpdesk_bank_id'],
					'problem_datetime' => $backup['HelpdeskTicket']['problem_datetime'],
					'money_amount' => $backup['HelpdeskTicket']['money_amount'],
					'sla_date' => $backup['HelpdeskTicket']['sla_date'],
					'helpdesk_user_level_id' => $backup['HelpdeskTicket']['helpdesk_user_level_id'],
					'ticket_status' => $backup['HelpdeskTicket']['ticket_status'],
					'priority' => $backup['HelpdeskTicket']['priority'],
					'created_by' => $backup['HelpdeskTicket']['modified_by']
				)
			));

			if ($create_backup) {
				if ($this->HelpdeskTicket->save($this->request->data)) {
					$this->Session->setFlash(__('The helpdesk ticket has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The helpdesk ticket could not be saved. Please, try again.'));
				}
			} else {
				$this->Session->setFlash(__('The helpdesk ticket could not be saved. Please, try again.'));
			}

		} else {
			$options = array('conditions' => array('HelpdeskTicket.' . $this->HelpdeskTicket->primaryKey => $id));
			$this->request->data = $this->HelpdeskTicket->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->HelpdeskTicket->id = $id;
		if (!$this->HelpdeskTicket->exists()) {
			throw new NotFoundException(__('Invalid helpdesk ticket'));
		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->HelpdeskTicket->delete()) {
			$this->Session->setFlash(__('The helpdesk ticket has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk ticket could not be deleted. Please, try again.'));
		}

		return $this->redirect(array('action' => 'index'));
	}

	private function __initAjax()
	{
		Configure::write ('debug', 2);
		$this->autoRender = false;
		$this->disableCache();
	}

	public function ajax_ticket_process()
	{
		$this->__initAjax();

		// Create a backup for current edited row
		$options = array('conditions' => array('HelpdeskTicket.' . $this->HelpdeskTicket->primaryKey => $this->request->data['ticket_id']));
		$backup = $this->HelpdeskTicket->find('first', $options);

		$this->HelpdeskTicket->HelpdeskTicketTrack->create();
		$create_backup = $this->HelpdeskTicket->HelpdeskTicketTrack->save(array(
			'HelpdeskTicketTrack' => array(
				'helpdesk_ticket_id' => $backup['HelpdeskTicket']['id'],
				'customer_name' => $backup['HelpdeskTicket']['customer_name'],
				'customer_email' => $backup['HelpdeskTicket']['customer_email'],
				'account_number' => $backup['HelpdeskTicket']['account_number'],
				'helpdesk_transaction_unit_id' => $backup['HelpdeskTicket']['helpdesk_transaction_unit_id'],
				'helpdesk_atm_id' => $backup['HelpdeskTicket']['helpdesk_atm_id'],
				'helpdesk_bank_id' => $backup['HelpdeskTicket']['helpdesk_bank_id'],
				'problem_datetime' => $backup['HelpdeskTicket']['problem_datetime'],
				'money_amount' => $backup['HelpdeskTicket']['money_amount'],
				'sla_date' => $backup['HelpdeskTicket']['sla_date'],
				'helpdesk_user_level_id' => $backup['HelpdeskTicket']['helpdesk_user_level_id'],
				'ticket_status' => $backup['HelpdeskTicket']['ticket_status'],
				'priority' => $backup['HelpdeskTicket']['priority'],
				'created_by' => $backup['HelpdeskTicket']['modified_by']
			)
		));

		// --- end create backup

		if ($create_backup) {
			$solution = $this->request->data['solution_desc'] == 'null' ? null : "'".$this->request->data['solution_desc']."'";

			$data = array(
				'HelpdeskTicket.ticket_status' => $this->request->data['ticket_status'],
				'HelpdeskTicket.modified_by' => $this->Auth->user('id'),
				'HelpdeskTicket.solution_desc' => $solution
			);

			$update = $this->HelpdeskTicket->updateAll($data, array(
				'HelpdeskTicket.id' => $this->request->data['ticket_id'],
				'HelpdeskTicket.ticket_number' => $this->request->data['ticket_number']
			));

			$this->response->type(array('json' => 'application/json'));
			$this->response->type('json');

			echo json_encode(array('resp' => 'OK'));

		} else {
			$this->response->type(array('json' => 'application/json'));
			$this->response->type('json');

			echo json_encode(array('resp' => 'FAILED'));
		}
	}

}
