<?php
App::uses('AppController', 'Controller');

class HelpdeskTransactionUnitPicController extends AppController {

	public $uses = array('HelpdeskTransactionUnitPic', 'HelpdeskTransactionUnit', 'User');

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
		return $this->redirect(array('action' => 'pra_assign_transaction_unit'));
		
	}

	public function pra_assign_transaction_unit()
	{
		$this->set('users', $this->User->find('all', array('conditions' => array('User.role' => 2))));
		$this->set('__js_append', array('jquery.dataTables.min', 'users/users_pra_assign_transaction_unit'));
	}

	public function assign_transaction_unit($pic_id)
	{
		if ($this->request->is('post')) {
			$data = array();
			foreach ($this->request->data['units'] as $unit_item) {
				array_push($data, array(
					'HelpdeskTransactionUnitPic' => array(
						'helpdesk_transaction_unit_id' => $unit_item,
						'user_id' => $this->request->data['pic_id']
					)
				));
			}
			
			$this->HelpdeskTransactionUnitPic->deleteAll(array('HelpdeskTransactionUnitPic.user_id' => $pic_id), false);
			$this->HelpdeskTransactionUnitPic->saveMany($data);
			$this->Session->setFlash(__('Process success.'));
			return $this->redirect(array('action' => 'pra_assign_transaction_unit'));
		}

		$trx_units = $this->HelpdeskTransactionUnit->all_transaction_units();
		$trx_units_pic = $this->HelpdeskTransactionUnitPic->find('all', array(
			'fields' => array('HelpdeskTransactionUnitPic.helpdesk_transaction_unit_id'),
			'conditions' => array(
				'HelpdeskTransactionUnitPic.user_id' => $pic_id
			)
		));

		$trx_units_seq = array();
		foreach ($trx_units_pic as $item) {
			array_push($trx_units_seq, $item['HelpdeskTransactionUnitPic']['helpdesk_transaction_unit_id']);
		}

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $pic_id));
		$pic = $this->User->find('first', $options);

		$this->set(compact('trx_units', 'trx_units_seq', 'pic'));
	}

}