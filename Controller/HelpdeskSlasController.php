<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskSlas Controller
 *
 * @property HelpdeskSla $HelpdeskSla
 * @property PaginatorComponent $Paginator
 */
class HelpdeskSlasController extends AppController {

	public $uses = array('HelpdeskSla', 'HelpdeskTransaction', 'HelpdeskTransactionType');

/**
 * Components
 *
 * @var array
 */
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
		$this->HelpdeskSla->recursive = 2;
		$this->set('helpdeskSlas', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['HelpdeskSla']['created_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskSla']['modified_by'] = $this->Auth->user('id');

			if ($this->request->data['HelpdeskSla']['helpdesk_atm_id'] === 0) {
				$this->request->data['HelpdeskSla']['helpdesk_atm_id'] = null;
			}

			$this->HelpdeskSla->create();
			if ($this->HelpdeskSla->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk sla has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk sla could not be saved. Please, try again.'));
			}
		}

		$helpdeskTransactions = $this->HelpdeskTransaction->find('list');

		$helpdeskTransactionTypes = $this->HelpdeskTransactionType->find('list');
		$helpdeskTransactionTypes[0] = '---';

		$helpdeskAtms = $this->HelpdeskSla->HelpdeskAtm->find('list', array(
			'conditions' => array('HelpdeskAtm.parent_id' => null)
		));

		$helpdeskAtms[0] = '---';

		$this->set(compact(
			'helpdeskAtms',
			'helpdeskTransactions',
			'helpdeskTransactionTypes'
		));

		$this->set('__js_append', array('helpdesk_sla/helpdesk_sla_add_edit'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskSla->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk sla'));
		}

		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['HelpdeskSla']['modified_by'] = $this->Auth->user('id');

			if ($this->request->data['HelpdeskSla']['helpdesk_atm_id'] === 0) {
				$this->request->data['HelpdeskSla']['helpdesk_atm_id'] = null;
			}
			
			if ($this->HelpdeskSla->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk sla has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk sla could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskSla.' . $this->HelpdeskSla->primaryKey => $id));
			$this->request->data = $this->HelpdeskSla->find('first', $options);
		}

		$helpdeskTransactions = $this->HelpdeskTransaction->find('list');

		$helpdeskTransactionTypes = $this->HelpdeskTransactionType->find('list');
		$helpdeskTransactionTypes[0] = '---';

		$helpdeskAtms = $this->HelpdeskSla->HelpdeskAtm->find('list', array(
			'conditions' => array('HelpdeskAtm.parent_id' => null)
		));

		$helpdeskAtms[0] = '---';

		$helpdeskTransactionUnits = $this->HelpdeskSla->HelpdeskTransactionUnit->find('list', array(
			'conditions' => array(
				'HelpdeskTransactionUnit.helpdesk_transaction_id' => $this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_id'],
				'HelpdeskTransactionUnit.helpdesk_transaction_type_id' => $this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_type_id']
			)
		));

		$this->set(compact(
			'helpdeskTransactions',
			'helpdeskTransactionTypes',
			'helpdeskAtms',
			'helpdeskTransactionUnits'
		));

		$this->set('__js_append', array('helpdesk_sla/helpdesk_sla_add_edit'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->HelpdeskSla->id = $id;
		if (!$this->HelpdeskSla->exists()) {
			throw new NotFoundException(__('Invalid helpdesk sla'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskSla->delete()) {
			$this->Session->setFlash(__('The helpdesk sla has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk sla could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
