<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        
        <!-- Bootstrap stylesheets -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap.min.css" />
        
        <!-- Fluent stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fluent.css" />
        

	<title><?php echo CHtml::encode(Yii::app()->name); ?></title>
</head>

<body>

<div class="container" id="page">
    <!-- Header -->
        <?php 
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'fixed' => false,
            'brand' => CHtml::encode(Yii::app()->name),
            'brandUrl' => Yii::app()->homeUrl,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    /*'items' => array(
                        array( 'label' => 'Home', 'url' => '/', 'active' => true),
                        array( 'label' => 'Contact', 'url' => 'contact.html'),
                        array( 'label' => 'About', 'url' => 'about.html')
                    )*/
                    'items' => MenuController::getMenuItems(),
                ),
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'items'=> MenuController::getUserItems(),
                )
        )));?> <!-- Header -->
        
        <div id="breadcrumbs">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
        </div>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
                <?php $this->widget('application.widgets.BlockWidget', array('name' => 'test')); ?>
	</div><!-- footer -->
</div><!-- page -->

</body>
</html>