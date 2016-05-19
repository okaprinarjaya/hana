<div class="helpdeskBanks index">
	<div class="page-header">
		<h2><?php echo __('List Bank Locations'); ?></h2>
	</div>

	
	<table class="table table-striped table-hover">
		<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('bank_location'); ?></th>
			<th><?php echo $this->Paginator->sort('bank_address'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>

	<tbody>
	<?php foreach ($helpdeskBanks as $helpdeskBank): ?>
	<tr>
		<td><?php echo h($helpdeskBank['HelpdeskBank']['id']); ?>&nbsp;</td>
		<td><?php echo h($helpdeskBank['HelpdeskBank']['bank_location']); ?>&nbsp;</td>
		<td><?php echo h($helpdeskBank['HelpdeskBank']['bank_address']); ?>&nbsp;</td>
		<td><?php echo h($helpdeskBank['HelpdeskBank']['created']); ?>&nbsp;</td>
		<td><?php echo h($helpdeskBank['HelpdeskBank']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $helpdeskBank['HelpdeskBank']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $helpdeskBank['HelpdeskBank']['id']), null, __('Are you sure you want to delete # %s?', $helpdeskBank['HelpdeskBank']['id'])); ?>
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
	<h3><?php echo __('Bank Locations'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('New Bank Locations'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>
