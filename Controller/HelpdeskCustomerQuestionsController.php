<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskCustomerQuestions Controller
 *
 * @property HelpdeskCustomerQuestion $HelpdeskCustomerQuestion
 * @property PaginatorComponent $Paginator
 */
class HelpdeskCustomerQuestionsController extends AppController {

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
		// Construct conditions
		$conditions = array();

		if (isset($this->request->query['date_from']) && !empty($this->request->query['date_from'])) {
			$conditions['DATE(HelpdeskCustomerQuestion.created) BETWEEN ? AND ?'] = array($this->request->query['date_from'], $this->request->query['date_to']);
		}

		if (isset($this->request->query['question_category']) && $this->request->query['question_category'] !== '0') {
			$conditions['HelpdeskCustomerQuestion.helpdesk_question_type_id'] = $this->request->query['question_category'];
		}

		$this->Paginator->settings = array(
			'conditions' => $conditions,
'order' => array('HelpdeskCustomerQuestion.created' => 'desc')
		);
		
		$categories = $this->HelpdeskCustomerQuestion->HelpdeskQuestionType->find('list');
		$categories[0] = '-- ALL --';
		
		$this->HelpdeskCustomerQuestion->recursive = 0;
		$this->set('helpdeskCustomerQuestions', $this->Paginator->paginate());
		$this->set('categories', $categories);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['HelpdeskCustomerQuestion']['created_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskCustomerQuestion']['modified_by'] = null;

			$this->HelpdeskCustomerQuestion->create();
			if ($this->HelpdeskCustomerQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk customer question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk customer question could not be saved. Please, try again.'));
			}
		}
		$helpdeskQuestionTypes = $this->HelpdeskCustomerQuestion->HelpdeskQuestionType->find('list');
		$this->set(compact('helpdeskQuestionTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskCustomerQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk customer question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HelpdeskCustomerQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk customer question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk customer question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskCustomerQuestion.' . $this->HelpdeskCustomerQuestion->primaryKey => $id));
			$this->request->data = $this->HelpdeskCustomerQuestion->find('first', $options);
		}
		$helpdeskQuestionTypes = $this->HelpdeskCustomerQuestion->HelpdeskQuestionType->find('list');
		$this->set(compact('helpdeskQuestionTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->HelpdeskCustomerQuestion->id = $id;
		if (!$this->HelpdeskCustomerQuestion->exists()) {
			throw new NotFoundException(__('Invalid helpdesk customer question'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskCustomerQuestion->delete()) {
			$this->Session->setFlash(__('The helpdesk customer question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk customer question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
