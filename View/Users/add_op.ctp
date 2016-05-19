<div class="users cake-elements form">

	<div class="page-header">
		<h2><?php echo __('Add Operator Account'); ?></h2>
	</div>

	<?php echo $this->Form->create('User'); ?>

	<div class="form-bg">
	<?php
	echo $this->Form->input('username', array('label' => 'PIC Account name'));
	echo $this->Form->input('userpassword', array('type' => 'password', 'label' => 'Password'));
	echo $this->Form->input('fullname', array('label' => 'Fulll name'));
	echo $this->Form->input('email');
	?>
    </div>

	<?php echo $this->Form->end(__('Submit')); ?>
	
</div>

<div class="actions">
	<h3><?php echo __('User Accounts'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('List Operator'), array('action' => 'index', 'op'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>