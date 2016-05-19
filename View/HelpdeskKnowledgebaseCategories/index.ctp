<div class="helpdeskKnowledgebaseCategories cake-elements form">

	<div class="page-header">
		<h2><?php echo __('Add knowledge category'); ?></h2>
	</div>

	<?php
	echo $this->Form->create('HelpdeskKnowledgebaseCategory');
	?>

	<div class="form-bg">
	<?php
	echo $this->Form->input('category_name');
	echo $this->Form->input('order_item');
	?>
	</div>

	<?php
	echo $this->Form->end(__('Add'));
	?>

	<div class="page-header">
		<h2><?php echo __('Knowledge category list'); ?></h2>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('category_name'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th><?php echo $this->Paginator->sort('created_by'); ?></th>
				<th><?php echo $this->Paginator->sort('modified_by'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($helpdeskKnowledgebaseCategories as $helpdeskKnowledgebaseCategory): ?>
			<tr>
				<td><?php echo h($helpdeskKnowledgebaseCategory['HelpdeskKnowledgebaseCategory']['id']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskKnowledgebaseCategory['HelpdeskKnowledgebaseCategory']['category_name']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskKnowledgebaseCategory['HelpdeskKnowledgebaseCategory']['created']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskKnowledgebaseCategory['HelpdeskKnowledgebaseCategory']['modified']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskKnowledgebaseCategory['CreatedInfo']['username']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskKnowledgebaseCategory['ModifiedInfo']['username']); ?>&nbsp;</td>

				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $helpdeskKnowledgebaseCategory['HelpdeskKnowledgebaseCategory']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $helpdeskKnowledgebaseCategory['HelpdeskKnowledgebaseCategory']['id']), null, __('Are you sure you want to delete # %s?', $helpdeskKnowledgebaseCategory['HelpdeskKnowledgebaseCategory']['id'])); ?>
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
	<h3><?php echo __('Knowledge Categories'); ?></h3>
</div>
