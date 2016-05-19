<!DOCTYPE html>
<html>
    <head>
        <title>Uploader</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php echo $this->Html->css('/Media/css/style'); ?>
        <?php echo $this->fetch('css'); ?>
    </head>
    <body>

	   <?php echo $this->Session->flash('Auth'); ?>
	   <?php echo $this->Session->flash(); ?>

       <?php echo $this->fetch('content'); ?>

        <?php
        echo $this->Html->script(array(
            '/media/js/jquery-1.8.3.min',
            '/media/js/jquery-ui-1.10.3.min'
        ));
        ?>

        <?php echo $this->fetch('script'); ?>

		<script type="text/javascript">
		</script>

    </body>
</html>