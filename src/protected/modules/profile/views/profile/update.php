<?php 
$this->pageTitle = Yii::app()->name . ' - '.Yum::t( "Profile");
$this->breadcrumbs=array(
		Yum::t('Edit profile'));
$this->title = Yum::t('Edit profile');

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage profiles'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<div class="form">
    <fieldset class="edit-form">

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary(array($user, $profile)); ?>

<?php if(Yum::module()->loginType & 1) { ?>
<div class="row">
<?php echo CHtml::activeLabelEx($user,'username'); ?>
<?php echo CHtml::activeTextField($user,'username',array(
			'size'=>20,'maxlength'=>20)); ?>
</div>
<?php } ?> 

<?php if(isset($profile) && is_object($profile)) 
	$this->renderPartial('/profile/_form', array('profile' => $profile)); ?>

	<div class="row buttons">
            <div class="row">
                <div class="column span-1">
                        <?php $this->widget('bootstrap.widgets.TbButton', 
                array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?>

                    <?php if(Yum::hasModule('avatar') && $user->id == Yii::app()->user->id): ?>
                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('avatar/avatar/editAvatar')?>"><?php echo Yii::t('admin', 'Avatar'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
	</div>

	<?php echo CHtml::endForm(); ?>
    </fieldset>
	</div><!-- form -->
