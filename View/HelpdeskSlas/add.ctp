<div class="helpdeskSlas cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Add new SLA'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskSla'); ?>

	<div class="form-bg">
		<?php
		// echo $this->Form->input('sla_code');
		echo $this->Form->input('Foo.helpdesk_transaction_id', array('label' => 'Transaction'));

		echo $this->Form->input('Foo.helpdesk_transaction_type_id', array(
			'options' => $helpdeskTransactionTypes,
			'default' => 0,
			'label' => 'Transaction Type'
		));

		echo $this->Form->input('helpdesk_transaction_unit_id', array(
			'options' => array(0 => '---'),
			'default' => 0,
			'label' => 'Transaction Unit',
			'style' => 'width:500px;'
		));

		echo $this->Form->input('helpdesk_atm_id', array(
			'options' => $helpdeskAtms,
			'label' => 'ATM Location',
			'default' => 0
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
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List SLAs'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
