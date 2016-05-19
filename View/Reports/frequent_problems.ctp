<div class="reports">
	
	<div class="page-header">
		<h2 class="report-title"><?php echo __('Frequent problems report'); ?></h2>
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

    <div class="page-header">
		<h2 class="report-title"><?php echo __('Results'); ?></h2>
	</div>

	<?php
    $ct_request_query = count($this->request->query);

    if ($ct_request_query > 0 && !empty($this->request->query['start_date']) && !empty($this->request->query['end_date'])):
    ?>

    <p style="font-size:1.3em; border-bottom:1px #DDDDDD solid; padding-bottom:10px;">
    	Report retrieval result from 
    	<span style="background:#1E8765; padding:3px; color:#FFFFFF; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;"><?php echo date('d F Y', strtotime($this->request->query['start_date'])); ?> </span>
    	&nbsp; to &nbsp;
    	<span style="background:#1E8765; padding:3px; color:#FFFFFF;  -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;"><?php echo date('d F Y', strtotime($this->request->query['end_date'])); ?> </span>
    </p>

    <?php
    endif;
    ?>

	<?php
	foreach ($trxs_report_container as $trx_item):
	?>

	<h3 style="font-size:1.2em;"><?php echo '<span class="hilite">'.$trx_item['trx_name'].'</span> - Frequent = <span class="hilite hilite-important">'.$trx_item['trx_counter'].'</span>'; ?></h3>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Trx type</th>
				<th>Trx unit name</th>
				<th>Trx unit frequent</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$c = count($trx_item['trx_unit_items']);

			if ($c !== 0):
			foreach ($trx_item['trx_unit_items'] as $item):
			?>
			<tr>
				<td><?php echo $item['trx_type']; ?></td>
				<td><?php echo $item['trx_unit_name']; ?></td>
				<td><span class="badge badge-info badge-lg"><?php echo $item['trx_unit_counter']; ?></span></td>
			</tr>
			<?php
			endforeach;
			else:
			?>

		    <tr>
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
				<th>Trx type</th>
				<th>Trx unit name</th>
				<th>Trx unit frequent</th>
			</tr>
		</tfoot>

	</table>

	<div style="border-bottom:1px #1E8765 solid;">&nbsp;</div>

	<?php
	endforeach;
	?>


</div>