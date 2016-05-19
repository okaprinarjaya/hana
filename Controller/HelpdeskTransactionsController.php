<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskTransactions Controller
 *
 * @property HelpdeskTransaction $HelpdeskTransaction
 * @property PaginatorComponent $Paginator
 */
class HelpdeskTransactionsController extends AppController {

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
		$this->HelpdeskTransaction->recursive = 0;
		$this->set('helpdeskTransactions', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['HelpdeskTransaction']['created_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskTransaction']['modified_by'] = $this->Auth->user('id');

			$this->HelpdeskTransaction->create();
			if ($this->HelpdeskTransaction->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk transaction has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk transaction could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskTransaction->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk transaction'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$this->request->data['HelpdeskTransaction']['modified_by'] = $this->Auth->user('id');

			if ($this->HelpdeskTransaction->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk transaction has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk transaction could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskTransaction.' . $this->HelpdeskTransaction->primaryKey => $id));
			$this->request->data = $this->HelpdeskTransaction->find('first', $options);
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
		$this->HelpdeskTransaction->id = $id;
		if (!$this->HelpdeskTransaction->exists()) {
			throw new NotFoundException(__('Invalid helpdesk transaction'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskTransaction->delete()) {
			$this->Session->setFlash(__('The helpdesk transaction has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk transaction could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
