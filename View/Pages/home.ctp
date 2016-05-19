<?php
foreach ($knowledges as $item):
?>
<div class="page-header">
    <h2><span class="glyphicon glyphicon-book"></span> <?php echo $item['category']; ?></h2>
</div>

<div class="row kb-item-wrap">
    <?php
    foreach ($item['items'] as $subItem):
    ?>

    <div class="col-md-4 kb-item">
        <h3>
        <?php
        echo $this->Html->link("<span class=\"glyphicon glyphicon-bookmark\"></span> ".$subItem['HelpdeskKnowledgebase']['title'], array('controller' => 'kb', 'action' => 'detail', $subItem['HelpdeskKnowledgebase']['id']), array('escape' => false));
        ?>
        </h3>

    </div>

    <?php
    endforeach;
    ?>
</div>

<?php
endforeach;
?>