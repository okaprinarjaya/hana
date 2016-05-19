<div class="helpdeskTransactionTypes index">

	<div class="page-header">
		<h2><?php echo __('List Holidays year period:').' <span style="color: #E66084; font-weight: bold; text-decoration: underline;">'.date('Y').'</span>'; ?></h2>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('holiday_name'); ?></th>
				<th>Start date</th>
				<th>Finish date</th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ($holidays as $holiday):
			?>
			<tr>
				<td><?php echo $holiday['Holiday']['holiday_name']; ?></td>
				<td><?php echo date('d F Y', strtotime($holiday['Holiday']['START_DATE'])); ?></td>
				<td><?php echo date('d F Y', strtotime($holiday['Holiday']['FINISH_DATE'])); ?></td>
				<td class="actions">
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $holiday['Holiday']['holiday_name'], $holiday['Holiday']['START_DATE'], $holiday['Holiday']['FINISH_DATE']), null, __('Are you sure you want to delete # %s?', $holiday['Holiday']['holiday_name'])); ?>
				</td>
			</tr>
			<?php
			endforeach;
			?>
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
	<h3><?php echo __('Setup Holidays'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('Add new holiday'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>
