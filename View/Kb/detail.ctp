<div class="page-header page-header-detail-page">
    <h2><span class="glyphicon glyphicon-bookmark"></span> <?php echo $article['HelpdeskKnowledgebase']['title']; ?></h2>
</div>

<div class="ckeditor-default">
<?php
echo $article['HelpdeskKnowledgebase']['content'];
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
                            foreach ($article['HelpdeskKnowledgebaseFile'] as $file):
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
                                	echo $this->Html->link("<i class=\"icon-pencil icon-white\"></i> ".__('download'), array('controller' => 'helpdesk_knowledgebases', 'action' => 'view_file', $file['id']), array('class' => 'btn btn-primary', 'escape' => false));
                                	?>
                                </td>

                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>