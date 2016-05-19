<div class="helpdeskAtms index">
	<div class="page-header">
		<h2><?php echo __('List ATM Locations'); ?></h2>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('atm_location'); ?></th>
				<th><?php echo $this->Paginator->sort('bank_code'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($helpdeskAtms as $helpdeskAtm): ?>
			<tr>
				<td><?php echo h($helpdeskAtm['HelpdeskAtm']['id']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskAtm['HelpdeskAtm']['atm_location']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskAtm['HelpdeskAtm']['bank_code']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskAtm['HelpdeskAtm']['created']); ?>&nbsp;</td>
				<td><?php echo h($helpdeskAtm['HelpdeskAtm']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $helpdeskAtm['HelpdeskAtm']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $helpdeskAtm['HelpdeskAtm']['id']), null, __('Are you sure you want to delete # %s?', $helpdeskAtm['HelpdeskAtm']['id'])); ?>
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
	<h3><?php echo __('ATM Locations'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('New ATM Locations'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>
