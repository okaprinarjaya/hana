<div class="helpdeskTransactionUnits index">

	<div class="page-header">
		<h2><?php echo __('List Transaction Units'); ?></h2>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('helpdesk_transaction_id', 'Transaction'); ?></th>
				<th><?php echo $this->Paginator->sort('helpdesk_transaction_type_id', 'Transaction type'); ?></th>
				<th><?php echo $this->Paginator->sort('unit_name'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($helpdeskTransactionUnits as $helpdeskTransactionUnit): ?>
			<tr>
				<td><?php echo h($helpdeskTransactionUnit['HelpdeskTransactionUnit']['id']); ?>&nbsp;</td>
				<td>
					<?php echo h($helpdeskTransactionUnit['HelpdeskTransaction']['transaction_name']); ?>
				</td>

				<td>
					<?php echo h($helpdeskTransactionUnit['HelpdeskTransactionType']['type_name']); ?>
				</td>

				<td><?php echo h($helpdeskTransactionUnit['HelpdeskTransactionUnit']['unit_name']); ?>&nbsp;</td>

				<td>
					<?php
					echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List PIC'), "#", array('class' => 'btn btn-default btn-mini pic-list', 'id' => 'item-'.$helpdeskTransactionUnit['HelpdeskTransactionUnit']['id'], 'escape' => false));
					?>

					<?php
					echo $this->Html->link("<i class=\"icon-pencil\"></i> ".__('Edit'), array('action' => 'edit', $helpdeskTransactionUnit['HelpdeskTransactionUnit']['id']), array('class' => 'btn btn-default btn-mini', 'escape' => false));
					?>
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
	<h3><?php echo __('Transaction Units'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('New transaction unit'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>

<div class="clear"></div>

<div id="dialog-modal" title="PIC of Selected transaction units">
	
</div>