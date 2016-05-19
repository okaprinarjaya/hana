<div class="helpdeskSlas cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Edit SLA'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskSla'); ?>
	<div class="form-bg">
    	<?php
    	echo $this->Form->input('id');
    	// echo $this->Form->input('sla_code');

		echo $this->Form->input('Foo.helpdesk_transaction_id', array(
			'label' => 'Transaction',
			'default' => $this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_id'],
		));

		echo $this->Form->input('Foo.helpdesk_transaction_type_id', array(
			'options' => $helpdeskTransactionTypes,
			'default' => $this->request->data['HelpdeskTransactionUnit']['helpdesk_transaction_type_id'],
			'label' => 'Transaction Type'
		));

		echo $this->Form->input('helpdesk_transaction_unit_id', array(
			'options' => $helpdeskTransactionUnits,
			'default' => $this->request->data['HelpdeskSla']['helpdesk_transaction_unit_id'],
			'label' => 'Transaction Unit',
			'style' => 'width:500px;'
		));

		echo $this->Form->input('helpdesk_atm_id', array(
			'options' => $helpdeskAtms,
			'label' => 'ATM Location',
			'default' => $this->request->data['HelpdeskSla']['helpdesk_atm_id']
		));
		
		echo $this->Form->input('sla_days');
		?>
	</div>
	<?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('SLA'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List Slas'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>

	    <li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('Add new SLA'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
