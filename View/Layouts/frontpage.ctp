<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>HanaBank Knowledge Base</title>

    <!-- Bootstrap core CSS -->
    <?php echo $this->Html->css('twbs3/bootstrap.min'); ?>

    <!-- Custom styles for this template -->
    <?php echo $this->Html->css('twbs3/jumbotron'); ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <?php echo $this->Html->script('twbs3/html5shiv'); ?>
        <?php echo $this->Html->script('twbs3/respond.min'); ?>
    <![endif]-->
</head>

<body>
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="<?php echo $this->Html->url('/'); ?>">
                    Knowledge Base
                </a>

            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $this->Html->url('/users/login'); ?>"><span class="glyphicon glyphicon-lock"></span> Helpdesk Administration</a></li>
                </ul>
            </div><!--/.navbar-collapse -->
        </div>
    </div>

    <div class="container">

        <div class="search-area">
            <h3 class="search-header">Have a Question?</h3>
            <p class="search-tag-line">If you have any question you can ask below or enter what you are looking for!</p>
            <?php $q = isset($this->request->query['key']) ? $this->request->query['key'] : ''; ?>

            <form id="search-form" class="form-inline" method="get" action="/helpdesk/kb/search" autocomplete="off" novalidate="novalidate">
                <input class="form-control input-lg" type="text" id="s" name="key" placeholder="Type your search terms here" title="* Please enter a search term!" autocomplete="off" style="width:800px;" value="<?php echo $q; ?>" />
                <button type="submit" class="btn btn-default input-lg"><span class="glyphicon glyphicon-search"></span> Search</button>
            </form>
        </div>

        <?php echo $this->fetch('content'); ?>


    </div> <!-- /container -->

    <div id="footer">
      <div class="container">
        <p class="text-muted">Hana Bank Knowledge Base</p>
      </div>
    </div>

    <?php echo $this->element('sql_dump'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <?php echo $this->Html->script('jquery-1.10.2'); ?>
    <?php echo $this->Html->script('twbs3/bootstrap.min'); ?>
</body>
</html>