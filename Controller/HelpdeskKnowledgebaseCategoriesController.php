<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskKnowledgebaseCategories Controller
 *
 * @property HelpdeskKnowledgebaseCategory $HelpdeskKnowledgebaseCategory
 * @property PaginatorComponent $Paginator
 */
class HelpdeskKnowledgebaseCategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is('post')) {

			$this->request->data['HelpdeskKnowledgebaseCategory']['created_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskKnowledgebaseCategory']['modified_by'] = null;

			$this->HelpdeskKnowledgebaseCategory->create();
			if ($this->HelpdeskKnowledgebaseCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk knowledgebase category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk knowledgebase category could not be saved. Please, try again.'));
			}
		}

		$this->HelpdeskKnowledgebaseCategory->recursive = 1;
		$this->set('helpdeskKnowledgebaseCategories', $this->Paginator->paginate());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskKnowledgebaseCategory->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk knowledgebase category'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['HelpdeskKnowledgebaseCategory']['modified_by'] = $this->Auth->user('id');

			if ($this->HelpdeskKnowledgebaseCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The helpdesk knowledgebase category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk knowledgebase category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskKnowledgebaseCategory.' . $this->HelpdeskKnowledgebaseCategory->primaryKey => $id));
			$this->request->data = $this->HelpdeskKnowledgebaseCategory->find('first', $options);
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
		$this->HelpdeskKnowledgebaseCategory->id = $id;
		if (!$this->HelpdeskKnowledgebaseCategory->exists()) {
			throw new NotFoundException(__('Invalid helpdesk knowledgebase category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskKnowledgebaseCategory->delete()) {
			$this->Session->setFlash(__('The helpdesk knowledgebase category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk knowledgebase category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}