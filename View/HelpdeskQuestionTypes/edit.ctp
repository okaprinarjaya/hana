<div class="modules cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Edit Customer question category'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskQuestionType'); ?>

	<div class="form-bg">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('type_name', array('label' => 'Category name'));
	?>
    </div>

	<?php echo $this->Form->end(__('Save')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Customer question categories'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List question categories'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>
