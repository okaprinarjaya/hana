<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskTransactionUnits Controller
 *
 * @property HelpdeskTransactionUnit $HelpdeskTransactionUnit
 * @property PaginatorComponent $Paginator
 */
class HelpdeskTransactionUnitsController extends AppController {

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
		$this->HelpdeskTransactionUnit->recursive = 0;
		$this->set('helpdeskTransactionUnits', $this->Paginator->paginate());
		$this->set('__js_append', array('jquery.dataTables.min', 'helpdesk_transaction_units/helpdesk_transaction_units_index'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['HelpdeskTransactionUnit']['created_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskTransactionUnit']['modified_by'] = $this->Auth->user('id');

			$this->HelpdeskTransactionUnit->create();
			if ($this->HelpdeskTransactionUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk transaction unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk transaction unit could not be saved. Please, try again.'));
			}
		}

		$helpdeskTransactions = $this->HelpdeskTransactionUnit->HelpdeskTransaction->find('list');
		$helpdeskTransactionTypes = $this->HelpdeskTransactionUnit->HelpdeskTransactionType->find('list');

		$this->set(compact('helpdeskTransactions', 'helpdeskTransactionTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskTransactionUnit->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk transaction unit'));
		}

		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['HelpdeskTransactionUnit']['modified_by'] = $this->Auth->user('id');

			if ($this->HelpdeskTransactionUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk transaction unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk transaction unit could not be saved. Please, try again.'));
			}

		} else {
			$options = array('conditions' => array('HelpdeskTransactionUnit.' . $this->HelpdeskTransactionUnit->primaryKey => $id));
			$this->request->data = $this->HelpdeskTransactionUnit->find('first', $options);
		}

		$helpdeskTransactions = $this->HelpdeskTransactionUnit->HelpdeskTransaction->find('list');
		$helpdeskTransactionTypes = $this->HelpdeskTransactionUnit->HelpdeskTransactionType->find('list');
		$this->set(compact('helpdeskTransactions', 'helpdeskTransactionTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->HelpdeskTransactionUnit->id = $id;
		if (!$this->HelpdeskTransactionUnit->exists()) {
			throw new NotFoundException(__('Invalid helpdesk transaction unit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskTransactionUnit->delete()) {
			$this->Session->setFlash(__('The helpdesk transaction unit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk transaction unit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}