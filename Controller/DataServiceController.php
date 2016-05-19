<?php
App::uses('AppController', 'Controller');

/**
 * DataServiceController Controller
 *
 */
class DataServiceController extends AppController
{
	public $uses = array('HelpdeskTransactionUnit', 'HelpdeskTicket', 'HelpdeskTransactionUnitPic', 'HelpdeskSla', 'Holiday');
	public $components = array('RequestHandler');

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

	private function __init()
	{
		Configure::write ('debug', 0);
		$this->autoRender = false;
		$this->disableCache();
	}

	public function transaction_units($trx_id, $trx_type_id)
	{
		$this->__init();

		$transaction_units = $this->HelpdeskTransactionUnit->find('all', array(
			'fields' => array('HelpdeskTransactionUnit.id', 'HelpdeskTransactionUnit.unit_name'),
			'conditions' => array(
				'HelpdeskTransactionUnit.helpdesk_transaction_id' => $trx_id,
				'HelpdeskTransactionUnit.helpdesk_transaction_type_id' => $trx_type_id
			)
		));

		$this->response->type(array('json' => 'application/json'));
		$this->response->type('json');

		echo json_encode($transaction_units);
	}

	public function ticket($ticket_id)
	{
		$this->__init();

		App::uses('CakeTime', 'Utility');
		$time = new CakeTime();

		$ticket_statuses = ticket_statuses();
		$user_levels = user_levels();
		$priorities = priorities();
		$currencies = currencies();
		$auth = $this->Auth->user();

		$ticket = $this->HelpdeskTicket->find('first', array(
			'conditions' => array(
				'HelpdeskTicket.id' => $ticket_id
			)
		));

		$ticket_str_body = "
		<input id=\"hide_ticket_id\" type=\"hidden\" name=\"hide_ticket_id\" value=\"{$ticket['HelpdeskTicket']['id']}\" />
		<input id=\"hide_ticket_number\" type=\"hidden\" name=\"hide_ticket_number\" value=\"{$ticket['HelpdeskTicket']['ticket_number']}\" />
		<input id=\"hide_priority\" type=\"hidden\" name=\"hide_priority\" value=\"{$ticket['HelpdeskTicket']['priority']}\" />
		<input id=\"hide_created_by\" type=\"hidden\" name=\"hide_created_by\" value=\"{$ticket['HelpdeskTicket']['created_by']}\" />
		";

		if ($ticket['HelpdeskTicket']['ticket_status'] != TICKET_STATUS_CLOSE) {
			$ticket_str_body .= "
			<div style=\"margin-bottom:5px;\">
			    <label>Solution</label>
			    <textarea id=\"solution\" disabled=\"disabled\"></textarea>
			</div>";
		} else {
			$ticket_str_body .= "
			<label>Solution</label>
			<div style=\"background-color:#FFFFFF; border:1px #DDDDDD; padding:5px; margin-bottom: 5px;\">
			    <p>{$ticket['HelpdeskTicket']['solution_desc']}</p>
			</div>";
		}

		if ($ticket['HelpdeskTicket']['ticket_status'] != TICKET_STATUS_CLOSE && in_array($this->Auth->user('role'),array(1,2))) {
			$ticket_str_body .= "
			<div style=\"margin-bottom:5px;\">
		    <label>Change ticket status</label>
		    <select id=\"ticket_status\" name=\"ticket_status\" onchange=\"ticket_status(this)\" style=\"width:200px;\">
		        <option value=\"\">---</option>
		        <option value=\"1\">On process</option>
		        <option value=\"2\">Closed</option>
		    </select>
		    </div>";
		}

		if ($ticket['HelpdeskTicket']['ticket_status'] != TICKET_STATUS_CLOSE && in_array($this->Auth->user('role'),array(1,2))) {
			$ticket_str_body .= "
			<button id=\"save-changes\" onclick=\"save_changes()\">Save changes</button>
			<div id=\"loading\"></div>
			<div class=\"clear\"></div>
			";
		}

		$ticket_str_body .= "
		<dl class=\"ticket-view block\">
		    <dt>Ticket status</dt>
		    <dd>
		        &nbsp;&nbsp; ".$ticket_statuses[$ticket['HelpdeskTicket']['ticket_status']]."
		    </dd>

		    <dt>Assignment level</dt>
			<dd>
				&nbsp;&nbsp; ".$user_levels[$ticket['HelpdeskTicket']['helpdesk_user_level_id']]."
			</dd>

			<dt>Priority</dt>
			<dd>
				&nbsp;&nbsp; ".$priorities[$ticket['HelpdeskTicket']['priority']]."
			</dd>

			<dt>Customer name</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskTicket']['customer_name']}			
			</dd>

<dt>Phone Number</dt>
<dd>
&nbsp;&nbsp; {$ticket['HelpdeskTicket']['phonenumber']}
</dd>

			<dt>Problem time</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskTicket']['problem_datetime']}
			</dd>

			<dt>Customer email</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskTicket']['customer_email']}
			</dd>

			<dt>Account number</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskTicket']['account_number']}
			</dd>

			<dt>Atm number</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskTicket']['atm_card_number']}
			</dd>

			<dt>Transaction unit</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskTransactionUnit']['unit_name']}
			</dd>

			<dt>ATM location</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskAtm']['atm_location']}
			</dd>

			<dt>Bank location</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskBank']['bank_location']}
			</dd>
			
			<dt>Money amount</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['HelpdeskTicket']['money_amount']}
			</dd>

			<dt>Money currency</dt>
			<dd>
				&nbsp;&nbsp; ".$currencies[$ticket['HelpdeskTicket']['money_currency']]."
			</dd>

			<dt>Created</dt>
			<dd>
				&nbsp;&nbsp; ".$time->format('F jS, Y', $ticket['HelpdeskTicket']['created'])."
			</dd>

			<dt>SLA Date</dt>
			<dd>
				&nbsp;&nbsp; ".$time->format('F jS, Y', $ticket['HelpdeskTicket']['sla_date'])."
			</dd>

			<dt>Modified</dt>
			<dd>
				&nbsp;&nbsp; ".$time->format('F jS, Y', $ticket['HelpdeskTicket']['modified'])."
			</dd>

			<dt>Created by</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['CreatedInfo']['fullname']}
			</dd>

			<dt>Modified by</dt>
			<dd>
				&nbsp;&nbsp; {$ticket['ModifiedInfo']['fullname']}
			</dd>
		</dl>\n\n";

		$st = "open";
		if ($ticket['HelpdeskTicket']['ticket_status'] == TICKET_STATUS_PROCESS) {
			$st = "process";
		} else if ($ticket['HelpdeskTicket']['ticket_status'] == TICKET_STATUS_CLOSE) {
			$st = "close";
		}

		$ticket_str_header = "
		<h3>Ticket: #{$ticket['HelpdeskTicket']['ticket_number']}</h3>
		<div class=\"ticket-problem {$st}\">
		    <p>{$ticket['HelpdeskTicket']['problem_desc']}</p>
		</div>
		";

		$ticket_content = $ticket_str_header.$ticket_str_body;

		$this->response->type(array('json' => 'application/json'));
		$this->response->type('json');

		echo json_encode(array('content' => $ticket_content));
	}

	public function atms($trx_unit_id)
	{
		$this->__init();

		$slas = $this->HelpdeskSla->find('all', array(
			'conditions' => array(
				'HelpdeskSla.helpdesk_transaction_unit_id' => $trx_unit_id
			)
		));

		$slas_count = count($slas);
		$atms = null;

		if ($slas_count === 1) {
			if ($slas[0]['HelpdeskSla']['helpdesk_atm_id'] == 0) {
				$atms = null;

			} else {
				$atms = $this->HelpdeskSla->HelpdeskAtm->find('threaded', array(
					'conditions' => array(
						'OR' => array('HelpdeskAtm.parent_id' => $slas[0]['HelpdeskSla']['helpdesk_atm_id'], 'HelpdeskAtm.id' => $slas[0]['HelpdeskSla']['helpdesk_atm_id'])
					)
				));
			}

		} else if ($slas_count === 2) {
			$atms = $this->HelpdeskSla->HelpdeskAtm->find('threaded');
		}

		$strOpts = "";
		$resp = array();

		if ($atms != null) {
			$strOpts .= "<option value=\"0\">---</option>";

			foreach ($atms as $item) {
				$strOpts .= "<option value=\"{$item['HelpdeskAtm']['id']}\">{$item['HelpdeskAtm']['atm_location']}</option>";
				$ct_child = count($item['children']);

				if ( $ct_child > 0) {
					foreach ($item['children'] as $itemL2) {
						$strOpts .= "<option value=\"{$itemL2['HelpdeskAtm']['id']}\">__{$itemL2['HelpdeskAtm']['atm_location']}</option>";
					}
				}
			}

			$resp['is_atms_null'] = 'no';
			$resp['content'] = $strOpts;

		} else {
			// Directly calculate SLA days
			$fetch_sla = $this->HelpdeskSla->find('first', array(
				'fields' => array('HelpdeskSla.sla_days'),
				'conditions' => array(
					'HelpdeskSla.helpdesk_transaction_unit_id' => $trx_unit_id,
					'HelpdeskSla.helpdesk_atm_id' => 0
				)
			));

			$now = date('Y-m-d');
			$finish_date = date('Y-m-d', strtotime("{$now} +{$fetch_sla['HelpdeskSla']['sla_days']} weekdays"));
			$holidays = $this->Holiday->get_holidays_by_date_range($now, $finish_date);

			$sla_date = getWDays($now, $holidays, $fetch_sla['HelpdeskSla']['sla_days']);

			$resp['is_atms_null'] = 'yes';
			$resp['content'] = array(
				'sla_days' => $fetch_sla['HelpdeskSla']['sla_days'],
				'sla_date' => $sla_date,
				'sla_date_human' => date('d F Y', strtotime($sla_date))
			);
		}

		$this->response->type(array('json' => 'application/json'));
		$this->response->type('json');

		echo json_encode($resp);
	}

	public function pic($trx_unit_id)
	{
		$this->__init();

		$pics = $this->HelpdeskTransactionUnitPic->find('all', array(
			'conditions' => array(
				'HelpdeskTransactionUnitPic.helpdesk_transaction_unit_id' => $trx_unit_id
			)
		));

		$content = "<table class=\"cake-table\">";
		$content .= "<thead>";
		$content .= "<tr>";
		$content .= "<th>PIC Account name</th>";
		$content .= "<th>PIC Full name</th>";
		$content .= "</tr>";
		$content .= "</thead>";

		$content .= "<tbody>";

		foreach ($pics as $pic_item) {
			$content .= "<tr>";
			$content .= "<td>{$pic_item['User']['username']}</td>";
			$content .= "<td>{$pic_item['User']['fullname']}</td>";
			$content .= "</tr>";
		}

		$content .= "</tbody>";

		$content .= "</table>";


		$this->response->type(array('json' => 'application/json'));
		$this->response->type('json');

		echo json_encode(array('content' => $content));
	}

	public function sla_info($trx_unit_id, $atm_id)
	{
		$this->__init();

		// First check in atm
		$x_atm_id = null;
		$atm = $this->HelpdeskSla->HelpdeskAtm->find('first', array(
			'conditions' => array('HelpdeskAtm.id' => $atm_id)
		));

		if ($atm['HelpdeskAtm']['parent_id'] == null) {
			$x_atm_id = $atm_id;
		} else {
			$x_atm_id = $atm['HelpdeskAtm']['parent_id'];
		}

		$sla = $this->HelpdeskSla->find('first', array(
			'fields' => array('HelpdeskSla.sla_days'),
			'conditions' => array(
				'HelpdeskSla.helpdesk_transaction_unit_id' => $trx_unit_id,
				'HelpdeskSla.helpdesk_atm_id' => $x_atm_id
			)
		));

		$now = date('Y-m-d');
		$finish_date = date('Y-m-d', strtotime("{$now} +{$sla['HelpdeskSla']['sla_days']} weekdays"));
		$holidays = $this->Holiday->get_holidays_by_date_range($now, $finish_date);

		$sla_date = getWDays($now, $holidays, $sla['HelpdeskSla']['sla_days']);

		$resp['content'] = array(
			'sla_days' => $sla['HelpdeskSla']['sla_days'],
			'sla_date' => $sla_date,
			'sla_date_human' => date('d F Y', strtotime($sla_date))
		);

		$this->response->type(array('json' => 'application/json'));
		$this->response->type('json');

		echo json_encode($resp);
	}
}
