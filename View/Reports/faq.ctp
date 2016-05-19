<div class="reports">

	<div class="page-header">
		<h2 class="report-title"><?php echo __('Frequently asked question report'); ?></h2>
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

    <!-- SHOW TICKETS -->

    <h3>Summary</h3>

    <div class="block">

	    <dl style="width:50%;">
	    	<?php
	    	foreach ($collection_of_counts as $k => $v):
	    	?>
	    	<dt><?php echo $info[$k]; ?></dt>
	    	<dd><span class="badge badge-info"><?php echo $v; ?></span></dd>
	    	<?php
	    	endforeach;
	    	?>
	    </dl>
	</div>

	<div class="clear" style="margin-bottom:25px;"></div>

	<h3>Details</h3>

	<?php
	$sum = array_sum($collection_of_counts);
	if ($sum !== 0):
	?>

	<p style="font-size:1.3em; color:#1E8765;">
		Frequently asked question is about: 
		<?php
		foreach ($highest_values as $x) {
			echo "<span class=\"badge label-info\">".$info[$x]."</span>";
			echo "&nbsp;&nbsp";
		}
		?>
	</p>

	<?php
	else:
	?>

    <p style="font-size:1.3em; color:#1E8765;">
    	There is no recorded customer questions
    </p>

    <?php
    endif;
    ?>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Customer name</th>
				<th>Question type</th>
				<th>note</th>
				<th>Created</th>
				<th>Created by</th>
			</tr>
		</thead>

		<tbody>
			<?php
			if ($sum !== 0):
			foreach ($questions as $item):
			?>
			<tr>
				<td><?php echo $item['HelpdeskCustomerQuestion']['customer_name']; ?></td>
				<td><?php echo $item['HelpdeskQuestionType']['type_name']; ?></td>
				<td><?php echo $item['HelpdeskCustomerQuestion']['note']; ?></td>
				<td><?php echo $item['HelpdeskCustomerQuestion']['created']; ?></td>
				<td><?php echo $item['CreatedInfo']['username']; ?></td>
			</tr>
			<?php
			endforeach;
			else:
			?>

			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>

			<?php
			endif;
			?>

		</tbody>

		<tfoot>
			<tr>
				<th>Customer name</th>
				<th>Question type</th>
				<th>note</th>
				<th>Created</th>
				<th>Created by</th>
			</tr>
		</tfoot>

	</table>

</div>