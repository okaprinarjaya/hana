<div class="modules cake-elements form">

	<div class="page-header">
		<h2><?php echo __('Add new customer question category'); ?></h2>
	</div>

	<?php
	echo $this->Form->create('HelpdeskQuestionType');
	?>

	<div class="form-bg">
	<?php
	echo $this->Form->input('type_name', array('label' => 'Category name'));
	?>
	</div>

	<?php
	echo $this->Form->end(__('Save'));
	?>

	<div class="page-header">
		<h2><?php echo __('Customer question category list'); ?></h2>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('type_name', 'Category name'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($helpdeskQuestionTypes as $item): ?>
			<tr>
				<td><?php echo h($item['HelpdeskQuestionType']['id']); ?>&nbsp;</td>
				<td><?php echo h($item['HelpdeskQuestionType']['type_name']); ?>&nbsp;</td>
				<td><?php echo h($item['HelpdeskQuestionType']['created']); ?>&nbsp;</td>
				<td><?php echo h($item['HelpdeskQuestionType']['modified']); ?>&nbsp;</td>

				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['HelpdeskQuestionType']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $item['HelpdeskQuestionType']['id']), null, __('Are you sure you want to delete # %s?', $item['HelpdeskQuestionType']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	    </tbody>

	</table>

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

</div>

<div class="actions">
	<h3><?php echo __('Customer question categories'); ?></h3>
</div>
