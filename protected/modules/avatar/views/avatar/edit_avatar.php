<div class="form">
<?php
$this->title = Yum::t('Upload avatar');

$this->breadcrumbs = array(
		Yum::t('Profile') => array('//profile/profile/view'),
		Yum::t('Upload avatar'));

if($model->avatar) {
	echo '<h2>';
	echo Yum::t('Your Avatar image');
	echo '</h2>';
	echo '<div class="pull-right">'.$model->getAvatar().'</div>';
}
else
	echo Yum::t('You do not have set an avatar image yet');

	echo '<br />';

if(Yum::module('avatar')->avatarMaxWidth != 0)
	echo '<p>' . Yum::t('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png') . '</p>';

	echo CHtml::errorSummary($model);
	echo CHtml::beginForm(array(
				'//avatar/avatar/editAvatar'), 'POST', array(
	'enctype' => 'multipart/form-data'));
	echo '<fieldset class="edit-form"><div>';
        echo CHtml::activeFileField($model, 'avatar');
	echo CHtml::error($model, 'avatar');
	echo '</div>';

	?>
        <!--<a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('avatar/avatar/enableGravatar')?>"><?php echo Yii::t('yum', 'Enable Gravatar'); ?></a>-->
        <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('avatar/avatar/removeAvatar')?>"><?php echo Yii::t('yum', 'Remove avatar'); ?></a> <?php
                  
	$this->widget('bootstrap.widgets.TbButton', 
                array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('yum','Upload')));
	echo CHtml::endForm();

?>
</fieldset>
</div>
