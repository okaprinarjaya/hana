<div class="modules">
	<div class="page-header">
		<h2><?php echo __('List Customers Questions'); ?></h2>
	</div>

	<a href="<?php echo $this->Html->url('/helpdesk_customer_questions/add'); ?>" class="btn btn-primary"><i class="icon-file icon-white"></i> Record new customer question</a>

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
				<i class="icon-tag"></i> Category 
				<?php
				echo $this->Form->input('question_category', array(
					'options' => $categories,
					'default' => isset($this->request->query['question_category']) ? $this->request->query['question_category'] : 0,
					'class' => 'input-medium'
				));
				?>

			</label>

			<button type="submit" class="btn"><i class="icon-search"></i> Search</button>
		</div>

		<?php echo $this->Form->end(); ?>

	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id', '#'); ?></th>
				<th><?php echo $this->Paginator->sort('customer_name', 'Customer'); ?></th>
				<th><?php echo $this->Paginator->sort('phonenumber'); ?></th>
				<th><?php echo $this->Paginator->sort('helpdesk_question_type_id', 'Category'); ?></th>
				<th><?php echo $this->Paginator->sort('note', 'Notes'); ?></th>
				<th style="width:100px;"><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('created_by'); ?></th>
				<th class="actions">&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ($helpdeskCustomerQuestions as $item):
			?>
			<tr>
				<td><?php echo $item['HelpdeskCustomerQuestion']['id']; ?></td>
				<td><?php echo $item['HelpdeskCustomerQuestion']['customer_name']; ?></td>
				<td><span class="label label-default"><?php echo $item['HelpdeskCustomerQuestion']['phonenumber']; ?></span></td>
				<td><span class="label label-info"><?php echo $item['HelpdeskQuestionType']['type_name']; ?></span></td>
				<td><?php echo $item['HelpdeskCustomerQuestion']['note']; ?></td>
				<td style="width:100px;"><?php echo $item['HelpdeskCustomerQuestion']['created']; ?></td>
				<td><?php echo $item['CreatedInfo']['username']; ?></td>

				<td class="actions">
					&nbsp;
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



<div id="dialog-modal" title="Ticket Detail">
	<div class="cake-elements" id="dialog-content">
	</div>
</div>