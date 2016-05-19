<div class="modules index">
	<div class="page-header">
		<h2><?php echo __('Add new knowledge article'); ?></h2>
	</div>

	<?php
	echo $this->Form->create('HelpdeskKnowledgebase', array('type' => 'file'));
	?>

	<?php
	echo $this->Form->input('helpdesk_knowledgebase_category_id', array(
		'options' => $helpdeskKnowledgeCategories,
		'label' => 'Article Category'
	));
	?>

	<label style="font-weight: bold;" for="title">Article Title</label>
	<input type="text" name="data[HelpdeskKnowledgebase][title]" class="input-xxlarge" id="title" style="width: 95%; padding:10px; font-size: 1.3em;" />

	<label style="font-weight: bold;" for="content">Article Content</label>
	<?php
	echo $this->Media->setRef('BaseUpload')->ckeditor('content');
	?>

	<div class="form-group" style="margin-top: 25px;">
                    <h2>Upload Files</h2>


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
	</ul>

</div>