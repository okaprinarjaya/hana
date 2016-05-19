<?php
App::uses('AppController', 'Controller');

/**
 * HelpdeskKnowledgebases Controller
 *
 * @property HelpdeskKnowledgebase $HelpdeskKnowledgebase
 * @property PaginatorComponent $Paginator
 */
class HelpdeskKnowledgebasesController extends AppController {

	public $helpers = array('Media.Media');

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
		$this->autoRender = false;

		$this->HelpdeskKnowledgebase->recursive = 0;
		$this->Paginator->settings = array('limit' => 100, 'order' => array(
		  'HelpdeskKnowledgebase.created' => 'desc'
		));
		
		$this->set('helpdeskKnowledgebases', $this->Paginator->paginate());
		$this->set('__js_append', array(
			'jquery.dataTables.min',
			'helpdesk_knowledgebases/helpdesk_knowledgebases_index'
		));

		if ($this->Auth->user('role') == 3) {
			$this->render('index_op');
		} else {
			$this->render('index');
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->HelpdeskKnowledgebase->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk knowledgebase'));
		}

		$options = array('conditions' => array('HelpdeskKnowledgebase.' . $this->HelpdeskKnowledgebase->primaryKey => $id));
		$this->set('helpdeskKnowledgebase', $this->HelpdeskKnowledgebase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['HelpdeskKnowledgebase']['created_by'] = $this->Auth->user('id');
			$this->request->data['HelpdeskKnowledgebase']['modified_by'] = null;

			$this->HelpdeskKnowledgebase->create();
			if ($this->HelpdeskKnowledgebase->save($this->request->data)) {
				$last = $this->HelpdeskKnowledgebase->getLastInsertID();
				$kbFiles = array();

				foreach ($this->request->data['uploads'] as $upload) {
					if ($upload['error'] != UPLOAD_ERR_NO_FILE) {
						move_uploaded_file($upload['tmp_name'], ROOT.DS.APP_DIR.DS.'webroot'.DS.'files'.DS.$upload['name']);
						$data = array(
							'HelpdeskKnowledgebaseFile' => array(
								'helpdesk_knowledgebase_id' => $last,
								'fname' => $upload['name'],
								'fsize' => $upload['size'],
								'ftype' => $upload['type']
							)
						);

						array_push($kbFiles, $data);
					}
				}

				$ct_upload_file = count($kbFiles);
				if ($ct_upload_file > 0) {
					$this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseFile->saveMany($kbFiles);
				}

				$this->Session->setFlash(__('The helpdesk knowledgebase has been saved.'));
				return $this->redirect(array('action' => 'index'));

			} else {
				$this->Session->setFlash(__('The helpdesk knowledgebase could not be saved. Please, try again.'));
			}
		}

		$helpdeskKnowledgeCategories = $this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseCategory->find('list');
		$this->request->data['BaseUpload']['id'] = 0;

		$this->set(compact('helpdeskKnowledgeCategories'));
		$this->set('__js_append', array('ckeditor/ckeditor'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HelpdeskKnowledgebase->exists($id)) {
			throw new NotFoundException(__('Invalid helpdesk knowledgebase'));
		}

		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['HelpdeskKnowledgebase']['created_by'] = $this->Auth->user('id');

			if ($this->HelpdeskKnowledgebase->save($this->request->data)) {

				$kbFiles = array();

				foreach ($this->request->data['uploads'] as $upload) {
					if ($upload['error'] != UPLOAD_ERR_NO_FILE) {
						move_uploaded_file($upload['tmp_name'], ROOT.DS.APP_DIR.DS.'webroot'.DS.'files'.DS.$upload['name']);
						$data = array(
							'HelpdeskKnowledgebaseFile' => array(
								'helpdesk_knowledgebase_id' => $id,
								'fname' => $upload['name'],
								'fsize' => $upload['size'],
								'ftype' => $upload['type'],
							)
						);

						array_push($kbFiles, $data);
					}
				}

				$ct_upload_file = count($kbFiles);
				if ($ct_upload_file > 0) {
					$this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseFile->saveMany($kbFiles);
				}

				$this->Session->setFlash(__('The helpdesk knowledgebase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The helpdesk knowledgebase could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HelpdeskKnowledgebase.' . $this->HelpdeskKnowledgebase->primaryKey => $id));
			$this->request->data = $this->HelpdeskKnowledgebase->find('first', $options);
		}

		$helpdeskKnowledgeCategories = $this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseCategory->find('list');
		$this->request->data['BaseUpload']['id'] = 0;
		
		$this->set(compact('helpdeskKnowledgeCategories'));
		$this->set('__js_append', array('ckeditor/ckeditor'));	

}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->HelpdeskKnowledgebase->id = $id;
		if (!$this->HelpdeskKnowledgebase->exists()) {
			throw new NotFoundException(__('Invalid helpdesk knowledgebase'));
		}
		
		$this->request->onlyAllow('post', 'delete');
		if ($this->HelpdeskKnowledgebase->delete()) {
			$this->Session->setFlash(__('The helpdesk knowledgebase has been deleted.'));
		} else {
			$this->Session->setFlash(__('The helpdesk knowledgebase could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function view_file($file_id) {
		$file = $this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseFile->find('first', array(
			'conditions' => array(
				'HelpdeskKnowledgebaseFile.id' => $file_id
			)
		));

		$this->response->file(ROOT.DS.APP_DIR.DS.'webroot'.DS.'files'.DS.$file['HelpdeskKnowledgebaseFile']['fname'], array(
			'download' => true,
			'name' => $file['HelpdeskKnowledgebaseFile']['fname']
		));

		return $this->response;		
	}

	public function delete_file($node_id, $file_id)
	{
		$this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseFile->id = $file_id;
		$filename = $this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseFile->field('fname');

		if (unlink(ROOT.DS.APP_DIR.DS.'webroot'.DS.'files'.DS.$filename)) {
			$this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseFile->delete();
			$this->Session->setFlash(__('A file has been deleted.'));
		} else {
			$this->Session->setFlash(__('The file could not be deleted. Please, try again.'));
		}

		return $this->redirect(array('action' => 'edit', $node_id));
	}
}