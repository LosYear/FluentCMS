<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap.min.css" />
        
        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div class="page">
            <div class ="header">
            <?php 
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'fixed' => 'top',
                'type' => 'inverse',
                //'class' => 'inverse',
                /*'htmlOptions' => array(
                  //'class' => 'navbar-static-top navbar-inverse',  
                    'style' => '.container{width:}',
                ),*/
                'brand' => CHtml::encode(Yii::app()->name),
                'brandUrl' => Yii::app()->homeUrl,
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => MenuDisplayController::getMenuItems(),
                    ),
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'htmlOptions' => array('class' => 'pull-right'),
                        'items' => MenuDisplayController::getRightItems(),
                    ),
                )));?> 
            </div>
            <div class="breadcrumbs">
              	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
                <?php endif?>  
            </div>
            <div class="content well">
                <?php echo $content; ?>
            </div>
            <?php if(isset($this->menu)):?>
                <div id="menu" class="well">
                    <?php $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'list',
                    'items'=>$this->menu,
                )); ?>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>
