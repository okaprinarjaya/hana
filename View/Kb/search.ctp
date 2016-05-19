<?php
foreach ($knowledges as $item):
?>

<ul>
	<li>
	<?php
    echo $this->Html->link("<span class=\"glyphicon glyphicon-bookmark\"></span> ".$item['HelpdeskKnowledgebase']['title'], array('controller' => 'kb', 'action' => 'detail', $item['HelpdeskKnowledgebase']['id']), array('escape' => false));
    ?>
    </li>
</ul>

<?php
endforeach;
?>

<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>