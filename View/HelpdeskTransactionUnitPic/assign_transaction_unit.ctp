<?php
$str = "<ul>";

foreach ($trx_units as $item) {
	$str .= "<li><span style=\"font-weight:bold;\">".$item['props']['HelpdeskTransaction']['transaction_name']."</span></li>";
	$ct = count($item['items']);

	if ($ct > 0) {
		$str .= "<ul>";

		foreach ($item['items'] as $itemL2) {
			$str .= "<li><span style=\"font-weight:bold;\">".$itemL2['props']['type_name']."</span></li>";
			$ctL2 = count($itemL2['items']);

			if ($ctL2 > 0) {
				$str .= "<table class=\"cake-table\">";

				foreach ($itemL2['items'] as $itemL3) {
					$str .= "<tr>";

					if (in_array($itemL3['id'], $trx_units_seq)) {
						$str .= "<td style=\"width:20px;\"><input type=\"checkbox\" name=\"units[]\" value=\"".$itemL3['id']."\" checked=\"checked\" /></td>";
					} else {
						$str .= "<td style=\"width:20px;\"><input type=\"checkbox\" name=\"units[]\" value=\"".$itemL3['id']."\" /></td>";
					}

					$str .= "<td>".$itemL3['unit_name']."</td>";
					$str .= "</tr>";
				}

				$str .= "</table>";
			}
		}

		$str .= "</ul>";
	}
}

$str .= "</ul>";
?>

<div class="helpdeskTransactionUnits cake-elements form">

	<div class="page-header">
		<h2><?php echo __('Assign this PIC to transaction units below'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskTransactionUnitPic'); ?>
	
	<h3 style="margin-top:25px;">PIC Detail information</h3>
	<input type="hidden" name="pic_id" value="<?php echo $pic['User']['id']; ?>" />

	<div class="block">
		<dl style="width: 30%;">
			<dt>PIC Account</dt>
			<dd><?php echo $pic['User']['username']; ?></dd>

			<dt>Full name</dt>
			<dd><?php echo $pic['User']['fullname']; ?></dd>
		</dl>
	</div>

	<div class="clear"></div>

	<h3 style="margin-top:25px;">List of Transaction units</h3>

	<div class="form-bg">
		<?php echo $str; ?>
	</div>

	<?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('Transactions'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('Choose PIC'), array('action' => 'pra_assign_transaction_unit'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
	
</div>