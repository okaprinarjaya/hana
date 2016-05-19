<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskTransactionTypes Controller
 *
 * @property HelpdeskTransactionType $HelpdeskTransactionType
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class HelpdeskTransactionTypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

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
		$this->HelpdeskTransactionType->recursive = 0;
		$this->set('helpdeskTransactionTypes', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->HelpdeskTransactionType->create();
			if ($this->HelpdeskTransactionType->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk transaction type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk transaction type could not be saved. Please, try again.'));
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
		if (!$this->HelpdeskTransactionType->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk transaction type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HelpdeskTransactionType->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk transaction type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk transaction type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskTransactionType.' . $this->HelpdeskTransactionType->primaryKey => $id));
			$this->request->data = $this->HelpdeskTransactionType->find('first', $options);
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
		$this->HelpdeskTransactionType->id = $id;
		if (!$this->HelpdeskTransactionType->exists()) {
			throw new NotFoundException(__('Invalid helpdesk transaction type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskTransactionType->delete()) {
			$this->Session->setFlash(__('The helpdesk transaction type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk transaction type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
