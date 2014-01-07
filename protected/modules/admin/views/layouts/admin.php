<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="page">
	<div class="header">
		<?php
			$this->widget('bootstrap.widgets.TbNavbar', array(
				'fixed' => false,
				'collapse' => true,
				'type' => 'inverse',
				//'class' => 'inverse',
				'htmlOptions' => array(
					'class' => 'navbar-static-top',
				),
				'brand' => 'Admin',
				'brandUrl' => Yii::app()->homeUrl,
				'items' => array(
					array(
						'class' => 'bootstrap.widgets.TbMenu',
						'items' => MenuDisplayController::getMenuItems(),
					),
					array(
							'class' => 'bootstrap.widgets.TbMenu',
							'items' => MenuDisplayController::getRightItems(),
						),
				)));?>
	</div>
	<div class="breadcrumbs">
		<?php if (isset($this->breadcrumbs)): ?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
		<?php endif ?>
	</div>
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 main-container">
		<div class="col-md-10 col-lg-10 col-sm-10 zero-padding content-container">
			<?php echo $content; ?>
		</div>
		<?php if (isset($this->menu) && !empty($this->menu)): ?>
			<div class="col-md-2 col-lg-2 col-sm-2 zero-padding panel panel-default">
				<?php $this->widget('bootstrap.widgets.TbMenu', array(
					'type' => 'list',
					'items' => $this->menu,
				)); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
</body>
</html>