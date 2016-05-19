<div class="helpdeskTransactionTypes cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Add Transaction Type'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskTransactionType'); ?>

	<div class="form-bg">
	<?php
		echo $this->Form->input('type_name');
	?>
    </div>

    <?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('Transaction Types'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List Transaction Types'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
