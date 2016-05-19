<div class="modules cake-elements form">
	<div class="page-header">
		<h2><?php echo __('Add Holiday year period:').' <span style="color: #E66084; font-weight: bold; text-decoration: underline;">'.date('Y').'</span>'; ?></h2>
	</div>

	<?php
	echo $this->Form->create('Holiday');
	?>

	<div class="form-bg">
		<table width="100%">
			<tr>
				<td>
					<?php
					echo $this->Form->input('Foo.start_date', array(
						'class' => 'datepicker',
						'required' => 'required'
					));
					?>
				</td>

				<td>
					<?php
					echo $this->Form->input('Foo.finish_date', array(
						'class' => 'datepicker',
						'required' => 'required'
					));
					?>
				</td>
			</tr>
		</table>

		<?php
		echo $this->Form->input('holiday_name');
		?>
    </div>

    <?php
    echo $this->Form->end(__('Submit'));
    ?>

</div>

<div class="actions">
	<h3><?php echo __('Setup Holidays'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List Holidays'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>
