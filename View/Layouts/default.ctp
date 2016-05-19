<?php
$cakeDescription = __d('cake_dev', 'Helpdesk System');
$id_days = id_days();
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>

	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>

	<?php
		// echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-responsive.min');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('app');
		echo $this->Html->css('flick/jquery-ui-1.10.4.custom');
		echo $this->Html->css('jquery.dataTables_themeroller');

		echo $this->Html->script('jquery-1.10.2');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
			<p>Welcome <strong><?php echo AuthComponent::user('fullname'); ?></strong> | <?php echo $id_days[date('N',time())]; ?>, <?php echo date('d/m/Y'); ?> | <a href="<?php echo $this->Html->url('/users/logout'); ?>" title="Logout"><i class="icon-off"></i>  Logout</a></p>
			<div class="clear"></div>
		</div>

		<div id="cssmenu">
			<?php echo $this->MenuNavigation->buildMenu($this->MenuNavigation->getMenuItems(AuthComponent::user('role')), $this->request->params); ?>
		</div>

		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->fetch('content'); ?>
		</div>

		<div id="footer">
		</div>
	</div>

	<div id="spinner"></div>

	<?php echo $this->element('sql_dump'); ?>

	<?php echo $this->Html->script('jquery-ui-1.10.4.custom.min'); ?>
	<?php echo $this->Html->script('spin.min'); ?>
	<?php echo $this->Html->script('app'); ?>

	<?php
	if (isset($__js_append)) {
		foreach ($__js_append as $item) {
		    echo $this->Html->script($item);
		    echo "\n";
		}
	}
	?>
</body>
</html>
