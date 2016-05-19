<div class="reports">
	<div class="page-header">
		<h2 class="report-title"><?php echo __('Tickets transaction'); ?></h2>
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
			<label class="control-label">
				<i class="icon-calendar"></i> Month from 
				<?php 
				echo $this->Form->input('start_month', array(
					'options' => $months,
					'default' => isset($this->request->query['start_month']) ? $this->request->query['start_month'] : $month_from,
					'label' => false,
					'div' => false,
					'class' => 'input-medium'
				));
				?>
			</label>

			<label class="control-label">
				<i class="icon-calendar"></i> Month to
				<?php 
				echo $this->Form->input('end_month', array(
					'options' => $months,
					'default' => isset($this->request->query['end_month']) ? $this->request->query['end_month'] : $month_to,
					'class' => 'input-medium'
				));
				?>
			</label>

			<label class="control-label">
				<i class="icon-calendar"></i> Year
				<?php
				echo $this->Form->input('year', array(
					'type' => 'date',
					'selected' => isset($this->request->query['year']['year']) ? $this->request->query['year']['year'].'-01-01' : $year.'-01-01',
					'dateFormat' => 'Y',
					'minYear' => date('Y') - 4,
					'maxYear' => date('Y'),
					'value' => date('Y'),
					'class' => 'input-small'
				));
				?>
			</label>

			<button type="submit" class="btn"><i class="icon-search"></i> Search</button>

		</div>

		<?php echo $this->Form->end(); ?>

	</div>

	<h3>Year: <?php echo $year; ?></h3>

	<table class="table table-striped table-hover">
		<tr class="tbl-row-data">
			<th style="text-align: left;">Month</th>
			<th>Total ticket</th>
			<th>Total OPEN</th>
			<th>Total ON PROCESS</th>
			<th>Total CLOSED</th>
		</tr>

		<?php foreach($rows as $item): ?>
		<tr class="tbl-row-data">
			<td style="text-align: left;">
				<?php echo $months[$item['month_series']['the_month']]; ?>
			</td>

			<td>
				<span class="badge badge-info"><?php echo $item[0]['total_ticket']; ?></span>
			</td>

			<td>
				<span class="badge badge-info"><?php echo $item[0]['total_open']; ?></span>
			</td>

			<td>
				<span class="badge badge-info"><?php echo $item[0]['total_onprocess']; ?></span>
			</td>

			<td>
				<span class="badge badge-info"><?php echo $item[0]['total_closed']; ?></span>
			</td>
		</tr>
	    <?php endforeach; ?>

	</table>

</div>

<div id="line" style="border:1px #DDDDDD solid; padding:3px;"></div>