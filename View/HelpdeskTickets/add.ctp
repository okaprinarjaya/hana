<div class="helpdeskTickets cake-elements form">
	
	<div class="page-header">
		<h2><?php echo __('Add Ticket'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskTicket'); ?>

	<div class="form-bg">
	<table>
		<tr>
			<td>
				<?php
				echo $this->Form->input('whatever', array(
					'options' => array('A' => 'Mr', 'B' => 'Ms', 'C' => 'Mrs'),
					'default' => !isset($this->request->data['HelpdeskTicket']['whatever']) ? 'A' : $this->request->data['HelpdeskTicket']['whatever'],
					'label' => '&nbsp;',
					'style' => 'width: 100px;'
				));
				?>
			</td>

			<td>
				<?php echo $this->Form->input('customer_name', array('style' => 'width: 500px;')); ?>
			</td>
		</tr>
	</table>

	<?php

	echo $this->Form->input('phonenumber');
	echo $this->Form->input('customer_email');
	echo $this->Form->input('account_number');
	echo $this->Form->input('atm_card_number');

	echo $this->Form->input('Foo.helpdesk_transaction_id', array(
		'options' => $helpdeskTransactions,
		'default' => !isset($this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_id']) ? 0 : $this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_id'],
		'label' => 'Transaction'
	));

	echo $this->Form->input('Foo.helpdesk_transaction_type_id', array(
		'options' => $helpdeskTransactionTypes,
		'default' => !isset($this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_type_id']) ? 0 : $this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_type_id'],
		'label' => 'Transaction Type'
	));

	if (!isset($this->request->data['HelpdeskTicket']['helpdesk_transaction_unit_id'])) {
		echo $this->Form->input('helpdesk_transaction_unit_id', array(
			'options' => array(0 => '---'),
			'default' => 0,
			'label' => 'Transaction Unit',
			'style' => 'width:800px;'
		));

	} else {
		echo $this->Form->input('helpdesk_transaction_unit_id', array(
			'options' => $helpdeskTransactionUnits,
			'default' => $this->request->data['HelpdeskTicket']['helpdesk_transaction_unit_id'],
			'label' => 'Transaction Unit'
		));
	}
	?>

	<?php
	if (isset($this->request->data['HelpdeskTicket']['helpdesk_atm_id'])):
		$strOpts = "";

		foreach ($helpdeskAtms as $item) {
			if ($this->request->data['HelpdeskTicket']['helpdesk_atm_id'] == $item['HelpdeskAtm']['id']) {
				$strOpts .= "<option value=\"{$item['HelpdeskAtm']['id']}\" selected=\"selected\">{$item['HelpdeskAtm']['atm_location']}</option>";
			} else {
				$strOpts .= "<option value=\"{$item['HelpdeskAtm']['id']}\">{$item['HelpdeskAtm']['atm_location']}</option>";
			}

			$ct_child = count($item['children']);

			if ($ct_child > 0) {
				foreach ($item['children'] as $itemL2) {
					if ($this->request->data['HelpdeskTicket']['helpdesk_atm_id'] == $itemL2['HelpdeskAtm']['id']) {
						$strOpts .= "<option value=\"{$itemL2['HelpdeskAtm']['id']}\" selected=\"selected\">___{$itemL2['HelpdeskAtm']['atm_location']}</option>";
					} else {
						$strOpts .= "<option value=\"{$itemL2['HelpdeskAtm']['id']}\">___{$itemL2['HelpdeskAtm']['atm_location']}</option>";
					}
				}
			}
		}
	?>

	<div class="input select">
		<label for="HelpdeskTicketHelpdeskAtmId">ATM Location</label>
		<select name="data[HelpdeskTicket][helpdesk_atm_id]" id="HelpdeskTicketHelpdeskAtmId" style="width:500px;">
			<?php echo $strOpts; ?>
		</select>
	</div>

    <?php else: ?>

	<div class="input select">
		<label for="HelpdeskTicketHelpdeskAtmId">ATM Location</label>
		<select name="data[HelpdeskTicket][helpdesk_atm_id]" id="HelpdeskTicketHelpdeskAtmId" style="width:500px;">
			<option value="0">---</option>
		</select>
	</div>

    <?php endif; ?>

	<div style="margin:0 0 10px 5px; padding:0 0 0 5px; background: yellow; color: #000000; display:none;" id="slatarget">
	</div>

	<?php
	echo $this->Form->input('sla_date', array('type' => 'hidden', 'default' => ''));
	?>

	<table>
		<tr>
			<td>
				<?php
				echo $this->Form->input('Foo.problem_date', array(
					'type' => 'text',
					'required' => 'required',
					'class' => 'datepicker',
					'style' => 'width: 200px;'
				));
				?>
			</td>

			<td>
				<?php
				echo $this->Form->input('Foo.problem_time', array(
					'type' => 'time',
					'timeFormat' => 24,
					'style' => 'width:100px;'
				));
				?>
			</td>
		</tr>
	</table>

	<table class="form-layout">
		<tr>
			<td style="width:320px;">
				<?php echo $this->Form->input('money_amount', array('type' => 'text', 'style' => 'width:300px;')); ?>
			</td>

			<td>
				<?php
				echo $this->Form->input('money_currency', array(
					'options' => array(1 => 'IDR', 2 => 'USD'),
					'style' => 'width:150px;'
				));
				?>
			</td>
		</tr>
	</table>

	<?php 
	echo $this->Form->input('priority', array('options' => array(1 => 'High', 2 => 'Medium', 3 => 'Low')));
	echo $this->Form->input('problem_desc', array('type' => 'textarea'));
	?>

	</div>

	<?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('Tickets'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List Tickets'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
