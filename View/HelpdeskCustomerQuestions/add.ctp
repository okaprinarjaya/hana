<div class="modules cake-elements form">
	<div class="page-header">
		<h2><?php echo __('New customer question record'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskCustomerQuestion'); ?>

	<div class="form-bg">
	<?php
	echo $this->Form->input('customer_name');
	echo $this->Form->input('phonenumber');

	echo $this->Form->input('helpdesk_question_type_id', array(
		'options' => $helpdeskQuestionTypes,
		'label' => 'Question category'
	));


	echo $this->Form->input('note', array('type' => 'textarea'));
	?>

	</div>

	<?php echo $this->Form->end(__('Save')); ?>

</div>

<div class="actions">
	<h3><?php echo __('Customer Questions'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List customer questions'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
