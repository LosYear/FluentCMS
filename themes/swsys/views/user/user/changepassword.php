<?php 
$this->pageTitle = Yum::t("Change password");

$this->breadcrumbs = array(
	Yum::t("Change password"));

if(isset($expired) && $expired)
	$this->renderPartial('password_expired');
?>

<div class="form login-form">
    <h1 class="title title_article"><?= Yum::t('Change password') ?></h1><br/>
<?php echo CHtml::beginForm('', 'POST', array('class' => 'form-horizontal')); ?>
	<?php echo CHtml::errorSummary($form, null, null, array('class' => 'alert alert-danger')); ?>

	<?php if(!Yii::app()->user->isGuest) {
		echo '<div class="row">';
		echo CHtml::activeLabelEx($form,'currentPassword'); 
		echo CHtml::activePasswordField($form,'currentPassword'); 
		echo '</div>';
	} ?>

<?php $this->renderPartial(
		'application.modules.user.views.user.passwordfields', array(
			'form'=>$form)); ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-2">
            <button type="submit" class="btn btn-default" id="btnSubmit"><?= Yii::t('yum', 'Save') ?></button>
        </div>
    </div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<style>
    * {
        box-sizing: border-box !important;
    }
</style>