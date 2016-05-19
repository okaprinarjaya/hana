<div class="helpdeskTransactions cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Edit transaction'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskTransaction'); ?>

		<div class="form-bg">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('transaction_name');
		?>
	    </div>

	<?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('Transactions'); ?></h3>
	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('List transactions'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
