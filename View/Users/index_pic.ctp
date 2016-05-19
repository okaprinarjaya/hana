<div class="users index">
	<div class="page-header">
		<h2><?php echo __('List PIC'); 
//App::uses('AppController', 'Controller');



?></h2>
	</div>
	

	<table class="table table-striped table-hover" style="margin-top:25px;">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('username', 'Account name'); ?></th>
				<th>Role</th>
				<th>PIC Level</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				<td><?php echo h($user['Role']['role_name']); ?>&nbsp;</td>
				<td><?php echo h($user['HelpdeskUserLevel']['level_name']); ?>&nbsp;</td>

				<td>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit_pic', $user['User']['id'])); ?>
				</td>

				
				<?php 
				//if ($user['User']['role']=="1") {
//if (data ['Role']['role_name'] =='Root') {
				//?>
				<td>
					<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $user['User']['id'])); ?>
				</td>
				<?php
					//}
				?>
				

				
			</tr>
		    <?php endforeach; ?>
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

<div class="actions">
	<h3><?php echo __('User Accounts'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('Add new PIC'), array('action' => 'add_pic'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>
</div>