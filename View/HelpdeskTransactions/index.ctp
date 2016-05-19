<div class="helpdeskTransactions index">
	<div class="page-header">
		<h2><?php echo __('List Transactions'); ?></h2>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('transaction_name'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($helpdeskTransactions as $helpdeskTransaction): ?>
			<tr>
				<td><?php echo h($helpdeskTransaction['HelpdeskTransaction']['id']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskTransaction['HelpdeskTransaction']['transaction_name']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskTransaction['HelpdeskTransaction']['created']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskTransaction['HelpdeskTransaction']['modified']); ?>&nbsp;</td>

				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $helpdeskTransaction['HelpdeskTransaction']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $helpdeskTransaction['HelpdeskTransaction']['id']), null, __('Are you sure you want to delete # %s?', $helpdeskTransaction['HelpdeskTransaction']['id'])); ?>
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
	<h3><?php echo __('Transactions'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('New Transaction'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>