
<div class="modules index">
	<div class="page-header">
		<h2><?php echo __('Detail Knowledge articles'); ?></h2>
	</div>

	<div class="page-header">
		<h3><i class="icon-bookmark"></i> <?php echo $helpdeskKnowledgebase['HelpdeskKnowledgebase']['title']; ?></h3>
	</div>

	<div class="ckeditor-default">
	<?php
	echo $helpdeskKnowledgebase['HelpdeskKnowledgebase']['content'];
	?>
    </div>

    <table class="table" style="margin-bottom: 20px;">
                        <thead>
                            <tr>
                                <th>File name</th>
                                <th>Uploaded date</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($helpdeskKnowledgebase['HelpdeskKnowledgebaseFile'] as $file):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $file['fname']; ?>
                                </td>

                                <td>
                                    <?php echo $file['created']; ?>
                                </td>

                                <td>
                                	<?php
                                	echo $this->Html->link("<i class=\"icon-pencil icon-white\"></i> ".__('download'), array('action' => 'view_file', $file['id']), array('class' => 'btn btn-primary', 'escape' => false));
                                	?>
                                </td>

                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>

</div>

<div class="actions">
	<h3><?php echo __('Knowledge articles'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List knowledge articles'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>
	</ul>

</div>