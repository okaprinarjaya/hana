<div class="helpdeskTickets">

	<div class="page-header">
		<h2><?php echo __('List Tickets'); ?></h2>
	</div>

	<a href="<?php echo $this->Html->url('/helpdesk_tickets/add'); ?>" class="btn btn-primary"><i class="icon-file icon-white"></i> New Ticket</a>

	<div class="form-actions">
		<?php
		echo $this->Form->create('Foo', array(
			'inputDefaults' => array(
				'div' => false,
				'label' => false
			),
			'type' => 'get',
			'class' => 'form-inline'
		));
		?>

		<div class="control-group">
			<label class="control-label" for="datefrom">
				<i class="icon-calendar"></i> Date from 
				<?php
				echo $this->Form->input('date_from', array(
					'default' => isset($this->request->query['date_from']) ? $this->request->query['date_from'] : '',
					'class' => 'input-medium datepicker'
				));
				?>
			</label>

			<label class="control-label" for="dateto">
				<i class="icon-calendar"></i> Date to 
				<?php
				echo $this->Form->input('date_to', array(
					'default' => isset($this->request->query['date_to']) ? $this->request->query['date_to'] : '',
					'class' => 'input-medium datepicker'
				));
				?>
			</label>

			<label class="control-label">
				<i class="icon-tag"></i> Status 
				<?php
				echo $this->Form->input('ticket_status', array(
					'options' => $ticket_statuses,
					'default' => isset($this->request->query['ticket_status']) ? $this->request->query['ticket_status'] : 'null',
					'class' => 'input-medium'
				));
				?>

			</label>
		</div>

		<div class="control-group">
			<label class="control-label">
				<i class="icon-resize-vertical"></i> Priority 
				<?php
				echo $this->Form->input('ticket_priority', array(
					'options' => $ticket_priorities,
					'default' => isset($this->request->query['ticket_priority']) ? $this->request->query['ticket_priority'] : 'null',
					'class' => 'input-medium'
				));
				?>
			</label>

			<label class="control-label">
				# Ticket number 
				<?php
				echo $this->Form->input('ticket_number', array(
					'default' => isset($this->request->query['ticket_number']) ? $this->request->query['ticket_number'] : '',
					'class' => 'input'
				));
				?>

			</label>

			<button type="submit" class="btn"><i class="icon-search"></i> Search</button>
		</div>

		<?php echo $this->Form->end(); ?>

	</div>

	<div style="margin-bottom:25px;">
		<a href="<?php echo $this->Html->url('/helpdesk_tickets?sort_by_status=open'); ?>" class="btn btn-danger">
		Ticket OPEN: <span class="badge badge-info"><?php echo $open; ?></span>
	    </a>

		<a href="<?php echo $this->Html->url('/helpdesk_tickets?sort_by_status=onprocess'); ?>" class="btn btn-warning">
		Ticket ONPROCESS: <span class="badge badge-info"><?php echo $onprocess; ?></span>
	    </a>

		<a href="<?php echo $this->Html->url('/helpdesk_tickets?sort_by_status=closed'); ?>" class="btn btn-success">
		Ticket CLOSED: <span class="badge badge-info"><?php echo $closed; ?></span>
	    </a>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr class="tbl-row">
				<th><?php echo $this->Paginator->sort('ticket_number', '#'); ?></th>
				<th><?php echo $this->Paginator->sort('ticket_status', 'Status'); ?></th>
				<th><?php echo $this->Paginator->sort('customer_name', 'Customer'); ?></th>
				<th><?php echo $this->Paginator->sort('helpdesk_transaction_unit_id', 'Transaction Unit'); ?></th>
				<th><?php echo $this->Paginator->sort('helpdesk_user_level_id', 'Assignment'); ?></th>
				<th style="width:100px;"><?php echo $this->Paginator->sort('created'); ?></th>
				<th style="width:100px;"><?php echo $this->Paginator->sort('sla_date', 'SLA Date'); ?></th>
				<th><?php echo $this->Paginator->sort('priority'); ?></th>
				<th>Overdue Lv1</th>
				<th>Overdue Lv2</th>
				<th>Overdue Lv3</th>
				<th class="actions">&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<?php 
			$label = array(
				0 => 'label-important',
				1 => 'label-warning',
				2 => 'label-success'
			);

			$overdue_label = array(
				'NO' => '<span class="label label-success"><i class="icon-minus icon-white"></i></span>',
				'YES' => '<span class="label label-important"><i class="icon-ok icon-white"></i></span>',
				'SOON' => '<span class="label label-warning"><i class="icon-exclamation-sign icon-white"></i></span>'
			);

			foreach ($helpdeskTickets as $helpdeskTicket): 
			?>
		    <tr>
		    	<td><span style="font-weight: bold;"><?php echo h($helpdeskTicket['HelpdeskTicket']['ticket_number']); ?>&nbsp;</span></td>
		    	<td>
		    		<span class="label <?php echo $label[$helpdeskTicket['HelpdeskTicket']['ticket_status']]; ?>">
		    			<?php echo strtolower($ticket_statuses[$helpdeskTicket['HelpdeskTicket']['ticket_status']]); ?>&nbsp;
		    		</span>
		    	</td>

		    	<td><?php echo h($helpdeskTicket['HelpdeskTicket']['customer_name']); ?>&nbsp;</td>

		    	<td>
		    		<span style="font-size:0.8em;">
		    			<?php echo h($helpdeskTicket['HelpdeskTransactionUnit']['unit_name']); ?>
		    		</span>
		    	</td>

		    	<td><?php echo $user_levels[$helpdeskTicket['HelpdeskTicket']['helpdesk_user_level_id']]; ?></td>
		    	<td><?php echo $this->Time->format($helpdeskTicket['HelpdeskTicket']['created'], '%e %b %Y'); ?>&nbsp;</td>
		    	<td><?php echo $this->Time->format($helpdeskTicket['HelpdeskTicket']['sla_date'], '%e %b %Y'); ?>&nbsp;</td>

		    	<td><?php echo h($ticket_priorities[$helpdeskTicket['HelpdeskTicket']['priority']]); ?>&nbsp;</td>

		    	<td><?php echo $overdue_label[$helpdeskTicket['HelpdeskTicket']['OVERDUE_LEVEL1']]; ?></td>
		    	<td><?php echo $overdue_label[$helpdeskTicket['HelpdeskTicket']['OVERDUE_LEVEL2']]; ?></td>
		    	<td><?php echo $overdue_label[$helpdeskTicket['HelpdeskTicket']['OVERDUE_LEVEL3']]; ?></td>

		    	<td>
		    		<a id="item-<?php echo $helpdeskTicket['HelpdeskTicket']['id']; ?>" href="#" title="View detail" class="btn btn-small ticket-detail">
		    			<i class="icon-eye-open"></i>
		    		</a>
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



<div id="dialog-modal" title="Ticket Detail">
	<div class="cake-elements" id="dialog-content">
	</div>
</div>
