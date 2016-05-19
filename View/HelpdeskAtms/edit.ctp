<div class="helpdeskAtms cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Edit ATM Location'); ?></h2>
	</div>

	<?php echo $this->Form->create('HelpdeskAtm'); ?>
	<div class="form-bg">
		<?php echo $this->Form->input('id'); ?>

		<?php
		$strOpts = "<option value=\"\">--- parent network ---</option>";
		
		foreach ($atms as $item) {
			if ($this->request->data['HelpdeskAtm']['parent_id'] == $item['HelpdeskAtm']['id']) {
				$strOpts .= "<option value=\"{$item['HelpdeskAtm']['id']}\" selected=\"selected\">{$item['HelpdeskAtm']['atm_location']}</option>";
			} else {
				$strOpts .= "<option value=\"{$item['HelpdeskAtm']['id']}\">{$item['HelpdeskAtm']['atm_location']}</option>";
			}
			
			$ct_child = count($item['children']);

			if ( $ct_child > 0) {
				foreach ($item['children'] as $itemL2) {
					$strOpts .= "<option value=\"{$itemL2['HelpdeskAtm']['id']}\">__{$itemL2['HelpdeskAtm']['atm_location']}</option>";
				}
			}
		}
		?>

		<div class="input select">
			<label for="HelpdeskAtmParentId">Network</label>
			<select name="data[HelpdeskAtm][parent_id]" id="HelpdeskAtmParentId" style="width:500px;">
				<?php echo $strOpts; ?>
			</select>
		</div>

		<!-- -->

		<?php echo $this->Form->input('atm_location'); ?>
		<?php echo $this->Form->input('bank_code'); ?>

	</div>
	<?php echo $this->Form->end(__('Submit')); ?>

</div>

<div class="actions">
	<h3><?php echo __('ATM Locations'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List ATM Locations'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>

	    <li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('New ATM Locations'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>
