<div class="helpdeskTransactionUnits index">
	<div class="page-header">
		<h2><?php echo __('List of PIC for transaction units assignment'); ?></h2>
	</div>

	<h3 style="margin-bottom:25px;">Choose PIC</h3>

	<table class="data-table" cellpadding="0" cellspacing="0" border="0" id="example" width="100%">
		<thead>
			<tr>
				<th>PIC Account</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$i = 1;
			foreach ($users as $user_item):
				$zebra = $i % 2 == 0 ? "even" : "odd";
			?>
			<tr class="<?php echo $zebra; ?>">
				<td><?php echo $this->Html->link($user_item['User']['username'], array('action' => 'assign_transaction_unit', $user_item['User']['id'])); ?></td>
			</tr>
			<?php
			$i++;
			endforeach;
			?>
		</tbody>

		<tfoot>
			<tr>
				<th>PIC Account</th>
			</tr>
		</tfoot>
	</table>
</div>


<div class="actions">
	<h3><?php echo __('PIC Assign transaction unit'); ?></h3>
</div>

<div class="clear"></div>