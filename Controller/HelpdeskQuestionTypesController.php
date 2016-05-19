<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskQuestionTypes Controller
 *
 * @property HelpdeskQuestionType $HelpdeskQuestionType
 * @property PaginatorComponent $Paginator
 */
class HelpdeskQuestionTypesController extends AppController {

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
		if ($this->request->is('post')) {
			$this->HelpdeskQuestionType->create();
			if ($this->HelpdeskQuestionType->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk question type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk question type could not be saved. Please, try again.'));
			}
		}

		$this->HelpdeskQuestionType->recursive = 0;
		$this->set('helpdeskQuestionTypes', $this->Paginator->paginate());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskQuestionType->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk question type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HelpdeskQuestionType->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk question type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk question type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskQuestionType.' . $this->HelpdeskQuestionType->primaryKey => $id));
			$this->request->data = $this->HelpdeskQuestionType->find('first', $options);
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
		$this->HelpdeskQuestionType->id = $id;
		if (!$this->HelpdeskQuestionType->exists()) {
			throw new NotFoundException(__('Invalid helpdesk question type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskQuestionType->delete()) {
			$this->Session->setFlash(__('The helpdesk question type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk question type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}