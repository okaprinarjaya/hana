<div class="reports">
	
	<div class="page-header">
		<h2 class="report-title"><?php echo __('Incoming customer call report'); ?></h2>
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
    ?>

    <p style="font-size:1.3em; border-bottom:1px #DDDDDD solid; padding-bottom:10px;">
    	Report retrieval result from 
    	<span style="background:#1E8765; padding:3px; color:#FFFFFF; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;"><?php echo date('d F Y', strtotime($this->request->query['start_date'])); ?> </span>
    	&nbsp; to &nbsp;
    	<span style="background:#1E8765; padding:3px; color:#FFFFFF;  -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;"><?php echo date('d F Y', strtotime($this->request->query['end_date'])); ?> </span>
    </p>

    <h3>Summary</h3>

    <div class="block">

	    <dl style="width:25%;">
	    	<dt><i class="icon-question-sign"></i> Questions</dt>
	    	<dd><span class="badge badge-info"><?php echo $count_questions; ?></span></dd>

	    	<dt><i class="icon-exclamation-sign"></i> Problems</dt>
	    	<dd><span class="badge badge-info"><?php echo $count_problems; ?></span></dd>

	    	<dt><i class="icon-plus-sign"></i> Total incoming call</dt>
	    	<dd><span class="badge badge-info"><?php echo $count_questions+$count_problems; ?></span></dd>
	    </dl>
	</div>

	<div class="clear" style="margin-bottom:25px;"></div>

	<h3>Details</h3>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><i class="icon-calendar"></i> Date</th>
				<th>Phone number</th>
				<th><i class="icon-user"></i> Customer name</th>
				<th><i class="icon-tag"></i> Issue type</th>
				<th><i class="icon-th-large"></i> Issue description</th>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ($rows as $item):
				$icon = $item['data_merge']['ISSUE_TYPE'] == 'QUESTION' ? "<i class=\"icon-question-sign icon-white	\"></i>" : "<i class=\"icon-exclamation-sign icon-white\"></i>";
			    $class_label = $item['data_merge']['ISSUE_TYPE'] == 'QUESTION' ? "label label-info" : "label label-important";
			?>
			<tr>
				<td><?php echo $item[0]['ISSUE_DATE_HUMAN']; ?></td>
				<td><span class="badge badge-default"><?php echo $item['data_merge']['phonenumber']; ?></span></td>
				<td><?php echo $item['data_merge']['customer_name']; ?></td>
				<td><span class="<?php echo $class_label; ?>"><?php echo $icon." ".$item['data_merge']['ISSUE_TYPE']; ?></span></td>
				<td><?php echo $item['data_merge']['ISSUE']; ?></td>
			</tr>
			<?php
			endforeach;
			?>
		</tbody>

		<tfoot>
			<tr>
				<th>Date</th>
				<th>Phone number</th>
				<th>Customer name</th>
				<th>Issue type</th>
				<th>Issue description</th>
			</tr>
		</tfoot>

	</table>

	<?php
	else:
	?>

    <!-- SHOW TICKETS -->

    <h3>Summary</h3>

    <div class="block">

	    <dl style="width:25%;">
	    	<dt><i class="icon-question-sign"></i> Questions</dt>
	    	<dd><span class="badge badge-info">0</span></dd>

	    	<dt><i class="icon-exclamation-sign"></i> Problems</dt>
	    	<dd><span class="badge badge-info">0</span></dd>

	    	<dt><i class="icon-plus-sign"></i> Total incoming call</dt>
	    	<dd><span class="badge badge-info">0</span></dd>
	    </dl>
	</div>

	<div class="clear" style="margin-bottom:25px;"></div>

	<h3>Details</h3>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><i class="icon-calendar"></i> Date</th>
				<th>Phone number</th>
				<th><i class="icon-user"></i> Customer name</th>
				<th><i class="icon-tag"></i> Issue type</th>
				<th><i class="icon-th-large"></i> Issue description</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		</tbody>

		<tfoot>
			<tr>
				<th>Date</th>
				<th>Phone number</th>
				<th>Customer name</th>
				<th>Issue type</th>
				<th>Issue description</th>
			</tr>
		</tfoot>

	</table>

	<?php
	endif;
	?>


</div>