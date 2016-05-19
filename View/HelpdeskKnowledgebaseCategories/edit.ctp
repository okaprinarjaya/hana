<div class="helpdeskKnowledgebaseCategories cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Edit Knowledgebase Category'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskKnowledgebaseCategory'); ?>

	<div class="form-bg">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('category_name');
	echo $this->Form->input('order_item');
	?>
    </div>

	<?php echo $this->Form->end(__('Save')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Knowledge Categories'); ?></h3>

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
