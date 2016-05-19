<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>

  <?php 
  echo $this->Html->css('reset');
  echo $this->Html->css('front');
  ?>

  <!--[if lt IE 9]><?php echo $this->Html->script('html5'); ?><![endif]-->
</head>
<body>
	<?php echo $this->fetch('content'); ?>
</body>
</html>