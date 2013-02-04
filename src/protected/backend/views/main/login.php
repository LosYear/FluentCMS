<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/login.css" media="screen, projection" />
        

	<title><?php echo CHtml::encode(Yii::app()->name); ?></title>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-frame">
            <div class="login-form">
                <?php /** @var BootActiveForm $form */
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'verticalForm',
                        'htmlOptions'=>array('class'=>'well'),
                    )); ?>

                    <div class="row-form"><?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?></div>
                    <div class="row-form"><?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?></div>
                    <div class="row-form submit scenter"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'buttonType'=>'submit', 
                                                                                'label'=>Yii::t('yum', 'Login'))); ?></div>

                    <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</body>
</html>