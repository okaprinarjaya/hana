<div class="reports">
	<div class="page-header">
		<h2 class="report-title"><?php echo __('Tickets problem related to ALTO / Prima Network'); ?></h2>
	</div>

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
			<label class="control-label" for="FooStartDate">
				<i class="icon-calendar"></i> Date from 
				<?php 
				echo $this->Form->input('start_date', array(
					'type' => 'text',
					'value' => isset($this->request->query['start_date']) ? $this->request->query['start_date'] : '',
					'class' => 'input-medium datepicker',
				));
				?>
			</label>

			<label class="control-label" for="FooEndDate">
				<i class="icon-calendar"></i> Date to 
				<?php 
				echo $this->Form->input('end_date', array(
					'type' => 'text',
					'value' => isset($this->request->query['end_date']) ? $this->request->query['end_date'] : '',
					'class' => 'datepicker',
				));
				?>
				
			</label>

			<button type="submit" class="btn"><i class="icon-search"></i> Search</button>

		</div>

		<?php echo $this->Form->end(); ?>

    </div>

    <?php
    $ct_request_query = count($this->request->query);

    if ($ct_request_query > 0 && !empty($this->request->query['start_date']) && !empty($this->request->query['end_date'])):
    	$user_levels = user_levels();
		$priorities = priorities();

		App::uses('CakeTime', 'Utility');
		$time = new CakeTime();
    ?>

    <!-- SHOW TICKETS -->

    <h3>Tickets</h3>
    
    <div class="block">

	    <dl style="width:25%;">
	    	<dt>Open</dt>
	    	<dd><span class="badge badge-info"><?php echo $open; ?></span></dd>

	    	<dt>On Process</dt>
	    	<dd><span class="badge badge-info"><?php echo $onprocess; ?></span></dd>

	    	<dt>Closed</dt>
	    	<dd><span class="badge badge-info"><?php echo $closed; ?></span></dd>
	    </dl>
	</div>

	<div class="clear" style="margin-bottom:25px;"></div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Date</th>
				<th>Ticket number</th>
				<th>Ticket status</th>
				<th>Network</th>
				<th>Customer</th>
				<th>Transaction unit</th>
				<th>Priority</th>
				<th>Assignment level</th>
			</tr>
	    </thead>

		<tbody>
			<?php foreach($tickets as $item): ?>
			<tr>
				<td><?php echo $time->format('F jS, Y', $item['HelpdeskTicket']['created']); ?></td>
				<td><?php echo $item['HelpdeskTicket']['ticket_number'] == null ? "-" : $item['HelpdeskTicket']['ticket_number']; ?></td>
				<td><?php echo $item['HelpdeskTicket']['ticket_status'] == null ? "-" : $ticket_statuses[$item['HelpdeskTicket']['ticket_status']]; ?></td>
				<td><?php echo $item['HelpdeskAtm']['atm_location']; ?></td>
				<td><?php echo $item['HelpdeskTicket']['customer_name']; ?> </td>
				<td><?php echo $item['HelpdeskTransactionUnit']['unit_name']; ?></td>
				<td><?php echo $priorities[$item['HelpdeskTicket']['priority']]; ?></td>
				<td><?php echo $user_levels[$item['HelpdeskTicket']['helpdesk_user_level_id']]; ?></td>
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

    <?php else: ?>

    <!-- SHOW TICKETS -->

    <h3>Tickets</h3>

    <div class="block">

	    <dl style="width:25%;">
	    	<dt>Open</dt>
	    	<dd><span class="badge badge-info">0</span></dd>

	    	<dt>On Process</dt>
	    	<dd><span class="badge badge-info">0</span></dd>

	    	<dt>Closed</dt>
	    	<dd><span class="badge badge-info">0</span></dd>
	    </dl>
	</div>

	<div class="clear" style="margin-bottom:25px;"></div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Date</th>
				<th>Ticket number</th>
				<th>Ticket status</th>
				<th>Network</th>
				<th>Customer</th>
				<th>Transaction unit</th>
				<th>Priority</th>
				<th>Assignment level</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		</tbody>

	</table>

    <?php endif; ?>

</div>