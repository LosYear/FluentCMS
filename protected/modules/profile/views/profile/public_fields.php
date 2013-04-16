<h2><?php echo $profile->name; ?></h2>
<a style='text-align: right; float:right;'><?php echo $profile->city; ?>, <?php echo $profile->school; ?></a>
<p><?php echo Yii::t('yum', 'Teacher').": ".$profile->teacher; ?></p>
<p><?php echo $profile->about; ?></p>
<div class="clear"></div>
