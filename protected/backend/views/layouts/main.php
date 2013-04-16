<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css"/>
		<title><?php echo CHtml::encode(Yii::app()->name); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="page">
			<div class ="header">
				<?php 
					$this->widget('bootstrap.widgets.TbNavbar', array(
					    'fixed' => 'top',
                                            'collapse' => true,
					    'type' => 'inverse',
					    //'class' => 'inverse',
					    /*'htmlOptions' => array(
					      //'class' => 'navbar-static-top navbar-inverse',  
					        'style' => '.container{width:1000px}',
					    ),*/
					    'brand' => CHtml::encode(Yii::app()->name),
					    'brandUrl' => Yii::app()->homeUrl,
					    'items' => array(
					        array(
					            'class' => 'bootstrap.widgets.TbMenu',
					            'items' => MenuDisplayController::getMenuItems(),
					        ),
					       /* array(
					            'class' => 'bootstrap.widgets.TbMenu',
					            'htmlOptions' => array('class' => 'pull-right'),
					            'items' => MenuDisplayController::getRightItems(),
					        ),*/
					    )));?> 
			</div>
			<div class="breadcrumbs">
				<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
				<?php endif?>  
			</div>
			<div class="container-fluid margin-10">
				<div class="row-fluid">
					<div class="span10 well well-small">
						<?php echo $content; ?>
					</div>
					<div class="span2 well well-small">
						<?php if(isset($this->menu)):?>
							<?php $this->widget('bootstrap.widgets.TbMenu', array(
								'type'=>'list',
								'items'=>$this->menu,
								)); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>