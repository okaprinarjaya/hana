<div class="users cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Edit Operator Account'); ?></h2>
	</div>

	<?php echo $this->Form->create('User'); ?>

	<div class="form-bg">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('username', array('label' => 'PIC Account name', 'disabled' => 'disabled'));

	echo $this->Form->input('userpassword', array('type' => 'password', 'label' => 'Password', 'disabled' => 'disabled'));
	echo $this->Form->input('Foo.change_password', array('type' => 'checkbox'));

	echo $this->Form->input('fullname', array('label' => 'Fulll name'));
	echo $this->Form->input('email');
	?>
    </div>

    <?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('PIC Account control'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('List PIC'), array('action' => 'index', 'op'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>

	    <li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('Add new PIC'), array('action' => 'add_op'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
	
</div>
