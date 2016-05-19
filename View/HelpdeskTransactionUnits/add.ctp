<div class="helpdeskTransactionUnits cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Add new transaction unit'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskTransactionUnit'); ?>
			
	<div class="form-bg">
	<?php
		echo $this->Form->input('helpdesk_transaction_id');
		echo $this->Form->input('helpdesk_transaction_type_id');
		echo $this->Form->input('unit_name');
	?>
    </div>

	<?php echo $this->Form->end(__('Submit')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Transaction Units'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List transaction unit'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
