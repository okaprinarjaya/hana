<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $uses = array('User', 'HelpdeskTransactionUnit', 'HelpdeskTransactionUnitPic');

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
		$this->Auth->loginAction = array('controller' => 'pages', 'action' => 'display', 'home');
	}

	public function isAuthorized($user)
	{
		return parent::isAuthorized($user);
	}

	public function login()
	{
if ($this->Auth->user()) {
    return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));

} else {
		$this->layout = 'login';

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}

			$this->Session->setFlash(__('Invalid username or password, try again'));
			return $this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index($account_type) {
		$role = $account_type == 'pic' ? 2 : 3;

		$this->User->recursive = 0;
		$this->Paginator->settings = array(
			'conditions' => array('User.role' => $role),
			'order' => array('User.created' => 'asc')
		);

		$this->set('users', $this->Paginator->paginate());
		$this->render('index_'.$account_type);
	}

/**
 * add method
 *
 * @return void
 */
	public function add_pic() {
		if ($this->request->is('post')) {

			$this->request->data['User']['role'] = 2;
			$this->request->data['User']['created_by'] = $this->Auth->user('id');
			$this->request->data['User']['modified_by'] = $this->Auth->user('id');

			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The PIC has been saved.'));
				return $this->redirect(array('action' => 'index', 'pic'));
			} else {
				$this->Session->setFlash(__('The PIC could not be saved. Please, try again.'));
			}
		}

		$roles = $this->User->Role->find('list');
		$user_levels = $this->User->HelpdeskUserLevel->find('list');

		$this->set(compact('roles', 'user_levels'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit_pic($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid PIC'));
		}

		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['User']['modified_by'] = $this->Auth->user('id');

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The PIC has been saved.'));
				return $this->redirect(array('action' => 'index', 'pic'));
			} else {
				$this->Session->setFlash(__('The PIC could not be saved. Please, try again.'));
			}

		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			$this->request->data['User']['userpassword'] = '';
		}

		$roles = $this->User->Role->find('list');
		$user_levels = $this->User->HelpdeskUserLevel->find('list');

		$this->set(compact('roles', 'user_levels'));
		$this->set('__js_append', array('users/users_edit'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add_op() {
		if ($this->request->is('post')) {

			$this->request->data['User']['role'] = 3;
			$this->request->data['User']['user_level_id'] = 0;

			$this->request->data['User']['created_by'] = $this->Auth->user('id');
			$this->request->data['User']['modified_by'] = null;

			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The Operator has been saved.'));
				return $this->redirect(array('action' => 'index', 'op'));
			} else {
				$this->Session->setFlash(__('The Operator could not be saved. Please, try again.'));
			}
		}

		$roles = $this->User->Role->find('list');

		$this->set(compact('roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit_op($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid PIC'));
		}

		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['User']['modified_by'] = $this->Auth->user('id');

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The Operator has been saved.'));
				return $this->redirect(array('action' => 'index', 'op'));
			} else {
				$this->Session->setFlash(__('The Operator could not be saved. Please, try again.'));
			}

		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			$this->request->data['User']['userpassword'] = '';
		}

		$roles = $this->User->Role->find('list');

		$this->set(compact('roles'));
		$this->set('__js_append', array('users/users_edit'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		//$this->request->is('post', 'delete');
		if ($this->Auth->user('email')=='rianawati@kebhana.co.id') {
			$this->User->delete();
			$this->Session->setFlash(__('The user has been deleted.'));
		} else if ($this->Auth->user('email')=='Novita.kusumawardhani@kebhana.co.id'){
			$this->User->delete();
			$this->Session->setFlash(__('The user has been deleted.'));

		}else{
			$this->Session->setFlash(__('You are not authorized to delete this user.'));
		}

		return $this->redirect(array('action' => 'index', 'pic'));
	}
}
