<div class="helpdeskBanks cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Edit Bank Locations'); ?></h2>
	</div>

<?php echo $this->Form->create('HelpdeskBank'); ?>

		<div class="form-bg">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('bank_location');
			echo $this->Form->input('bank_address');
		?>
	    </div>

<?php echo $this->Form->end(__('Submit')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Bank Locations'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List Helpdesk Banks'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>

	    <li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('New Bank Locations'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>
