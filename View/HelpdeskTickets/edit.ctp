<div class="helpdeskTickets cake-elements form">
	<div class="page-header">
		<h2>
			<?php echo __('Edit Ticket'); ?>
			#<?php echo $this->request->data['HelpdeskTicket']['ticket_number']; ?>
		</h2>
	</div>

	<?php echo $this->Form->create('HelpdeskTicket'); ?>	

	<div class="form-bg">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('ticket_status', array('type' => 'hidden'));
	?>

	<table>
		<tr>
			<td>
				<?php
				echo $this->Form->input('whatever', array(
					'options' => array('A' => 'Mr', 'B' => 'Ms', 'C' => 'Mrs'),
					'default' => $this->request->data['HelpdeskTicket']['whatever'],
					'label' => '&nbsp;',
					'style' => 'width: 100px;'
				));
				?>
			</td>

			<td>
				<?php echo $this->Form->input('customer_name', array('style' => 'width: 500px;')); ?>
			</td>
		</tr>
	</table>

	<?php
	echo $this->Form->input('phonenumber');
	echo $this->Form->input('customer_email');
	echo $this->Form->input('account_number');
	echo $this->Form->input('atm_card_number');
	?>

	<table>
		<tr>
			<td>
				<?php
				echo $this->Form->input('Foo.problem_date', array(
					'type' => 'text',
					'class' => 'datepicker',
					'style' => 'width: 200px;'
				));
				?>
			</td>

			<td>
				<?php
				echo $this->Form->input('Foo.problem_time', array(
					'type' => 'time',
					'timeFormat' => 24,
					'style' => 'width:100px;'
				));
				?>
			</td>
		</tr>
	</table>

	<table class="form-layout">
		<tr>
			<td style="width:320px;">
				<?php echo $this->Form->input('money_amount', array('type' => 'text', 'style' => 'width:300px;')); ?>
			</td>
			<td>
				<?php
				echo $this->Form->input('money_currency', array(
					'options' => array(1 => 'IDR', 2 => 'USD'),
					'style' => 'width:150px;'
				));
				?>
			</td>
		</tr>
	</table>

	<?php 
	echo $this->Form->input('priority', array('options' => array(1 => 'High', 2 => 'Medium', 3 => 'Low')));
	echo $this->Form->input('problem_desc', array('type' => 'textarea'));
	?>
    </div>


	<?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('Tickets'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List Tickets'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>

	    <li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('Add ticket'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>
