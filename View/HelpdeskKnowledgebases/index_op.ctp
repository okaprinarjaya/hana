<div class="modules index">
	<div class="page-header">
		<h2><?php echo __('List Knowledge articles'); ?></h2>
	</div>

	<table class="table table-striped table-hover" id="example">
		<thead>
			<tr>
				<th>#</th>
				<th>Article Category</th>
				<th>Article Title</th>
				<th>Created On</th>
				<th>Created By</th>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ($helpdeskKnowledgebases as $item):
			?>
			<tr>
				<td><?php echo $item['HelpdeskKnowledgebase']['id']; ?></td>
				<td><?php echo $item['HelpdeskKnowledgebaseCategory']['category_name']; ?></td>
				<td>
					<?php
					echo $this->Html->link("<i class=\"icon-bookmark\"></i> ".$item['HelpdeskKnowledgebase']['title'], array('action' => 'view', $item['HelpdeskKnowledgebase']['id']), array('escape' => false));
					?>
				</td>
				<td><?php echo $item['HelpdeskKnowledgebase']['created']; ?></td>
				<td><?php echo $item['CreatedInfo']['username']; ?></td>
			</tr>
			<?php
			endforeach;
			?>
		</tbody>

		<tfoot>
			<tr>
				<th>#</th>
				<th>Article Category</th>
				<th>Article Title</th>
				<th>Created On</th>
				<th>Created By</th>
			</tr>
		</tfoot>
	</table>

</div>

<div class="actions">
	<h3><?php echo __('Knowledge articles'); ?></h3>

</div>