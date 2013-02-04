<?php
if(!isset($model)) 
	$model = new YumUserLogin();

$module = Yum::module();

$this->pageTitle = Yii::t('yum', 'Login');
if(isset($this->title))
$this->title = Yii::t('yum', 'Login');
$this->breadcrumbs=array(Yii::t('yum', 'Login'));

Yum::renderFlash();
?>

<p>
<?php 
	echo Yii::t('yum', 'Please fill out the following form with your login credentials:'); ?>
</p>

<div class="form">
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<div class="row"><?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?></div>
<div class="row"><?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?></div>
<div class="row rememberMe"><?php echo $form->checkboxRow($model, 'rememberMe'); ?></div>
<div class="row submit"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'buttonType'=>'submit', 
                                                            'label'=>Yii::t('yum', 'Login'))); ?></div>
 
<?php $this->endWidget(); ?>
</div>

<?php
$form = new CForm(array(
			'elements'=>array(
				'username'=>array(
					'type'=>'text',
					'maxlength'=>32,
					),
				'password'=>array(
					'type'=>'password',
					'maxlength'=>32,
					),
				'rememberMe'=>array(
					'type'=>'checkbox',
					)
				),

			'buttons'=>array(
				'login'=>array(
					'type'=>'submit',
					'label'=>'Login',
					),
				),
			), $model);
?>

