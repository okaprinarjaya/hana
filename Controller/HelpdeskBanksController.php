<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskBanks Controller
 *
 * @property HelpdeskBank $HelpdeskBank
 * @property PaginatorComponent $Paginator
 */
class HelpdeskBanksController extends AppController {

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
		$this->HelpdeskBank->recursive = 0;
		$this->set('helpdeskBanks', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->HelpdeskBank->create();
			if ($this->HelpdeskBank->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk bank has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk bank could not be saved. Please, try again.'));
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
		if (!$this->HelpdeskBank->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk bank'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HelpdeskBank->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk bank has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk bank could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskBank.' . $this->HelpdeskBank->primaryKey => $id));
			$this->request->data = $this->HelpdeskBank->find('first', $options);
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
		$this->HelpdeskBank->id = $id;
		if (!$this->HelpdeskBank->exists()) {
			throw new NotFoundException(__('Invalid helpdesk bank'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskBank->delete()) {
			$this->Session->setFlash(__('The helpdesk bank has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk bank could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
