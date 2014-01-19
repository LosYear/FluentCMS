<?php
	if (!isset($model))
		$model = new YumUserLogin();

	$module = Yum::module();

	$this->pageTitle = Yii::t('yum', 'Login');
	if (isset($this->title))
//$this->title = Yii::t('yum', 'Login');
		$this->breadcrumbs = array(Yii::t('yum', 'Login'));

	Yum::renderFlash();
?>


<div class="form login-form">
	<?php $this->widget('bootstrap.widgets.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		'alerts'=>array( // configurations per alert type
			'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
		))); ?>
	<h1 class="title title_article"><?= Yii::t('main', 'Login') ?></h1><br/>
	<?php /** @var BootActiveForm $form */
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id' => 'verticalForm',
			'htmlOptions'=>array('class'=>'form-horizontal'),
		)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?= $form->label($model, 'username', array('class' => 'col-lg-3 control-label')) ?>
		<div class="col-lg-4">
			<?= $form->textField($model, 'username', array('class' => 'form-control')) ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'password', array('class' => 'col-lg-3 control-label')) ?>
		<div class="col-lg-4">
			<?= $form->passwordField($model, 'password', array('class' => 'form-control')) ?>
		</div>
	</div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
            <div class="checkbox">
                <label>
                    <?= $form->checkBox($model, 'rememberMe') ?>&nbsp;<?= Yii::t('yum', 'Remember me next time') ?>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
            <a href="<?= Yii::app()->createUrl('registration/registration/recovery') ?>"><?= Yii::t('yum', 'Forgot password?') ?></a>
        </div>
    </div>

	<div class="form-group">
		<div class="col-lg-offset-3 col-lg-2">
			<button type="submit" class="btn btn-default" id="btnSubmit"><?= Yii::t('yum', 'Login') ?></button>
		</div>
	</div>
    <style>
        * {
            box-sizing: border-box !important;
        }
    </style>

	<?php $this->endWidget(); ?>
</div>

<?php
	$form = new CForm(array(
		'elements' => array(
			'username' => array(
				'type' => 'text',
				'maxlength' => 32,
			),
			'password' => array(
				'type' => 'password',
				'maxlength' => 32,
			),
			'rememberMe' => array(
				'type' => 'checkbox',
			)
		),

		'buttons' => array(
			'login' => array(
				'type' => 'submit',
				'label' => 'Login',
			),
		),
	), $model);
?>
