<div class="helpdeskSlas index">
	<div class="page-header">
		<h2><?php echo __('List SLA'); ?></h2>
	</div>

	<table  class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('helpdesk_transaction_unit_id', 'Transaction unit'); ?></th>
				<th>Trx</th>
				<th>Sub Trx</th>
				<th><?php echo $this->Paginator->sort('helpdesk_atm_id', 'ATM Location'); ?></th>
				<th><?php echo $this->Paginator->sort('sla_days'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($helpdeskSlas as $helpdeskSla): ?>
			<tr>
				<td><?php echo h($helpdeskSla['HelpdeskSla']['id']); ?>&nbsp;</td>
				<td><?php echo $helpdeskSla['HelpdeskTransactionUnit']['unit_name']; ?></td>
				<td><?php echo $helpdeskSla['HelpdeskTransactionUnit']['HelpdeskTransaction']['transaction_name']; ?></td>
				<td><?php echo $helpdeskSla['HelpdeskTransactionUnit']['HelpdeskTransactionType']['type_name']; ?></td>
				<td>
					<?php echo h($helpdeskSla['HelpdeskAtm']['atm_location']); ?>
				</td>
				<td><?php echo h($helpdeskSla['HelpdeskSla']['sla_days']); ?>&nbsp;</td>

				<td>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $helpdeskSla['HelpdeskSla']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $helpdeskSla['HelpdeskSla']['id']), null, __('Are you sure you want to delete # %s?', $helpdeskSla['HelpdeskSla']['id'])); ?>
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
		?>
	</p>

	<div class="paging">
		<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
	
</div>

<div class="actions">
	<h3><?php echo __('SLA'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('Add new SLA'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
