<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskAtms Controller
 *
 * @property HelpdeskAtm $HelpdeskAtm
 * @property PaginatorComponent $Paginator
 */
class HelpdeskAtmsController extends AppController {

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
		$this->HelpdeskAtm->recursive = 0;
		$this->set('helpdeskAtms', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			if ($this->request->data['HelpdeskAtm']['parent_id'] == 0) {
				$this->request->data['HelpdeskAtm']['parent_id'] = null;
			}

			$this->HelpdeskAtm->create();
			if ($this->HelpdeskAtm->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk atm has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk atm could not be saved. Please, try again.'));
			}
		}

		$atms = $this->HelpdeskAtm->find('threaded');
		$this->set(compact('atms'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskAtm->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk atm'));
		}

		if ($this->request->is(array('post', 'put'))) {

			if ($this->request->data['HelpdeskAtm']['parent_id'] == "") {
				$this->request->data['HelpdeskAtm']['parent_id'] = null;
			}

			if ($this->HelpdeskAtm->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk atm has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk atm could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskAtm.' . $this->HelpdeskAtm->primaryKey => $id));
			$this->request->data = $this->HelpdeskAtm->find('first', $options);
		}

		$atms = $this->HelpdeskAtm->find('threaded');
		$this->set(compact('atms'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->HelpdeskAtm->id = $id;
		if (!$this->HelpdeskAtm->exists()) {
			throw new NotFoundException(__('Invalid helpdesk atm'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskAtm->delete()) {
			$this->Session->setFlash(__('The helpdesk atm has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk atm could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
