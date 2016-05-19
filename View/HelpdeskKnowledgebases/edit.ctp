<div class="modules index">
	<div class="page-header">
		<h2><?php echo __('Edit knowledge article'); ?></h2>
	</div>

	<?php
	echo $this->Form->create('HelpdeskKnowledgebase', array('type' => 'file', 'novalidate' => true));
	?>

	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('helpdesk_knowledgebase_category_id', array(
		'options' => $helpdeskKnowledgeCategories,
		'default' => $this->request->data['HelpdeskKnowledgebase']['helpdesk_knowledgebase_category_id'],
		'label' => 'Article Category'
	));
	?>

	<label style="font-weight: bold;" for="title">Article Title</label>
	<input type="text" name="data[HelpdeskKnowledgebase][title]" class="input-xxlarge" id="title" style="width: 95%; padding:10px; font-size: 1.3em;" value="<?php echo $this->request->data['HelpdeskKnowledgebase']['title']; ?>" />

	<label style="font-weight: bold;" for="content">Article Content</label>
	<?php
	echo $this->Media->setRef('BaseUpload')->ckeditor('content');
	?>

	<div class="form-group" style="margin-top: 25px;">
                    <h2>Upload Files</h2>

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
                            foreach ($this->request->data['HelpdeskKnowledgebaseFile'] as $file):
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
                                	echo $this->Html->link("<i class=\"icon-trash icon-white\"></i> ".__('delete'), array('action' => 'delete_file', $this->request->data['HelpdeskKnowledgebase']['id'], $file['id']), array('class' => 'btn btn-primary', 'escape' => false));
                                	?>
                                </td>

                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>


                    <?php
                    echo $this->Form->input('uploads.0', array(
                        'type' => 'file',
                        'label' => false,
                        'class' => 'form-control'
                    ));

                    echo "<hr />";

                    echo $this->Form->input('uploads.1', array(
                        'type' => 'file',
                        'label' => false,
                        'class' => 'form-control'
                    ));

                    echo "<hr />";

                    echo $this->Form->input('uploads.2', array(
                        'type' => 'file',
                        'label' => false,
                        'class' => 'form-control'
                    ));

                    echo "<hr />";

                    echo $this->Form->input('uploads.3', array(
                        'type' => 'file',
                        'label' => false,
                        'class' => 'form-control'
                    ));

                    echo "<hr />";

                    echo $this->Form->input('uploads.4', array(
                        'type' => 'file',
                        'label' => false,
                        'class' => 'form-control'
                    ));
                    ?>
                </div>

	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Save Article</button>
	</div>

    <?php
    echo $this->Form->end();
    ?>

</div>

<div class="actions">
	<h3><?php echo __('Knowledge articles'); ?></h3>

	<ul>
		<li>
		<?php
		echo $this->Html->link("<i class=\"icon-list\"></i> ".__('List knowledge articles'), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>

	    <li>
		<?php
		echo $this->Html->link("<i class=\"icon-file\"></i> ".__('New knowledge article'), array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false));
		?>
	    </li>

	    <li>
	    	<?php
	    	echo $this->Form->postLink(
	    		"<i class=\"icon-trash\"></i> ".__('Delete'),
	    		array('action' => 'delete', $this->request->data['HelpdeskKnowledgebase']['id']),
	    		array('class' => 'btn btn-danger', 'escape' => false),
	    		__('Are you sure you want to delete # %s?', $this->request->data['HelpdeskKnowledgebase']['title'])
	    	);
	    	?>
	    </li>
	</ul>

</div>
