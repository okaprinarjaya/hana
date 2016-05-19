<?php
App::uses('AppHelper', 'View/Helper');

class MenuNavigationHelper extends AppHelper {

	public $helpers = array('Html');
	private $menu = array();

	public function getMenuItems($role)
	{
		$this->menu[1] = array(
			array('dashboard','Dashboard', $this->Html->url('/dashboard')),
			array('master_data', 'Master data', array(
				//array('pic_trx_unit','PIC Transaction units assign', $this->Html->url('/helpdesk_transaction_unit_pic')),
				array('setup_holidays','Setup Holidays', $this->Html->url('/holidays')),
				array('transaction_unit','Transaction units', $this->Html->url('/helpdesk_transaction_units')),
				array('sla','SLA', $this->Html->url('/helpdesk_slas')),
				array('transaction','Transactions', $this->Html->url('/helpdesk_transactions')),
				array('transaction_type','Transaction Types', $this->Html->url('/helpdesk_transaction_types')),
				array('add_question_category','Question categories', $this->Html->url('/helpdesk_question_types')),
				array('atms','ATM Locations', $this->Html->url('/helpdesk_atms')),
				array('banks','Bank Locations', $this->Html->url('/helpdesk_banks'))
			)),
			array('user_accounts','User accounts', array(
			    array('user_account_pic','PIC Accounts', $this->Html->url('/users/index/pic')),
			    array('user_account_op','Operator Accounts', $this->Html->url('/users/index/op'))
			)),
			array('knowledgebase','Knowledge Base', array(
				array('kb_category','Knowledge category', $this->Html->url('/helpdesk_knowledgebase_categories')),
			    array('kb_write_article','Knowledge articles', $this->Html->url('/helpdesk_knowledgebases'))
			)),
			array('customer_question','Customer questions', $this->Html->url('/helpdesk_customer_questions')),
			array('tickets','Tickets', $this->Html->url('/helpdesk_tickets')),
			array('reports','Reports', array(
				array('report_cust_problems','Frequent problems', $this->Html->url('/reports/frequent_problems')),
				array('report_faq','Frequently asked question', $this->Html->url('/reports/faq')),
				array('report_incoming_call','Incoming customer call', $this->Html->url('/reports/incoming_call')),
				array('report_ticket_trx','Tickets transaction', $this->Html->url('/reports')),
				array('report_ticket_altoprima','Tickets problem ALTO / Prima', $this->Html->url('/reports/ticket_problem_alto_prima')),
				array('report_ticket_hana','Tickets problem HanaBank', $this->Html->url('/reports/ticket_problem_hanabank'))
			)),
		);

		$this->menu[2] = array(
			array('dashboard','Dashboard', $this->Html->url('/dashboard')),
			array('master_data', 'Master data', array(
				//array('pic_trx_unit','PIC Transaction units assign', $this->Html->url('/helpdesk_transaction_unit_pic')),
				array('setup_holidays','Setup Holidays', $this->Html->url('/holidays')),
				array('transaction_unit','Transaction units', $this->Html->url('/helpdesk_transaction_units')),
				array('sla','SLA', $this->Html->url('/helpdesk_slas')),
				array('transaction','Transactions', $this->Html->url('/helpdesk_transactions')),
				array('transaction_type','Transaction Types', $this->Html->url('/helpdesk_transaction_types')),
				array('add_question_category','Question categories', $this->Html->url('/helpdesk_question_types')),
				array('atms','ATM Locations', $this->Html->url('/helpdesk_atms')),
				array('banks','Bank Locations', $this->Html->url('/helpdesk_banks'))
			)),
			array('user_accounts','User accounts', array(
			    array('user_account_pic','PIC Accounts', $this->Html->url('/users/index/pic')),
			    array('user_account_op','Operator Accounts', $this->Html->url('/users/index/op'))
			)),
			array('knowledgebase','Knowledge Base', array(
				array('kb_category','Knowledge category', $this->Html->url('/helpdesk_knowledgebase_categories')),
			    array('kb_write_article','Knowledge articles', $this->Html->url('/helpdesk_knowledgebases'))
			)),
			array('customer_question','Customer questions', $this->Html->url('/helpdesk_customer_questions')),
			array('tickets','Tickets', $this->Html->url('/helpdesk_tickets')),
			array('reports','Reports', array(
				array('report_cust_problems','Frequent problems', $this->Html->url('/reports/frequent_problems')),
				array('report_faq','Frequently asked question', $this->Html->url('/reports/faq')),
				array('report_incoming_call','Incoming customer call', $this->Html->url('/reports/incoming_call')),
				array('report_ticket_trx','Tickets transaction', $this->Html->url('/reports')),
				array('report_ticket_altoprima','Tickets problem ALTO / Prima', $this->Html->url('/reports/ticket_problem_alto_prima')),
				array('report_ticket_hana','Tickets problem HanaBank', $this->Html->url('/reports/ticket_problem_hanabank'))
			)),
		);

		$this->menu[3] = array(
			array('dashboard','Dashboard', $this->Html->url('/dashboard')),
			array('kb_op_index','Knowledgebase', $this->Html->url('/helpdesk_knowledgebases')),
			array('customer_question','Customer questions', $this->Html->url('/helpdesk_customer_questions')),
			array('tickets','Tickets', $this->Html->url('/helpdesk_tickets'))

		);

		return $this->menu[$role];
	}

	public function childMenu($parent_name)
	{
		$childs = array(
			'master_data' => array(
				'helpdesk_transaction_units',
				'helpdesk_slas',
				'helpdesk_transactions',
				'helpdesk_transaction_types',
				'helpdesk_question_types',
				'helpdesk_atms',
				'helpdesk_banks',
				'helpdesk_transaction_unit_pic',
				'holidays'
			),
			'user_accounts' => array(
				'users'
			),
			'reports' => array(
				'reports'
			),
			'knowledgebase' => array(
				'helpdesk_knowledgebases',
				'helpdesk_knowledgebase_categories'
			)
		);

		return $childs[$parent_name];
	}

	public function buildMenu($menu_array, $request_params)
	{
		$req_ctrl = $this->Html->url('/').$request_params['controller'];
		$str_menu = "<ul>";

		foreach ($menu_array as $item) {
			if (!is_array($item[2])) {
				$active = $item[2] == $req_ctrl ? " class=\"active\"" : "";

				$str_menu .= "<li".$active.">";
				$str_menu .= "<a href=\"".$item[2]."\" title=\"".$item[1]."\">".$item[1]."</a>";
				$str_menu .= "</li>";

			} else {

				$active = in_array($request_params['controller'], $this->childMenu($item[0])) ? " class=\"active\"" : "";
				$str_menu .= "<li".$active.">";
				$str_menu .= "<a href=\"#\" title=\"".$item[1]."\">".$item[1]."</a>";
				$str_menu .= "<ul>";

				foreach ($item[2] as $level2) {
					$str_menu .= "<li>";
					$str_menu .= "<a href=\"".$level2[2]."\" title=\"".$level2[1]."\">".$level2[1]."</a>";
					$str_menu .= "</li>";
				}

				$str_menu .= "</ul>";
				$str_menu .= "</li>";
			}
		}

		$str_menu .= "</ul>";

		return $str_menu;
	}
}