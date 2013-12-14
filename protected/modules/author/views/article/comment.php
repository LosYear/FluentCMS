<?php
	$formatter = new CDateFormatter(Yii::app()->locale);

?>

<div class="comment-item">
	<div class="comment-date"><?php echo $formatter->formatDateTime($data->created, 'long', 'short'); ?>
		<?php if (Yii::app()->user->isAdmin()) : ?><span class="comment-remove" onclick="delete_comment(<?= $data->id ?>)"><span
				class="glyphicon glyphicon-remove"></span></span><?php endif; ?></div>
	<div class="comment-content"><?php echo $data->comment; ?>
	</div>
	<div class="comment-author">
		<span class="icon icon_person"></span><a class="link"
		                                         href="<?php echo Yii::app()->createUrl('author/profile/view', array('id' => $data->author_id)); ?>"><?php echo Profile::model()->findByPk($data->author_id)->name; ?></a>
	</div>
	<hr class="hr">
</div>

<script lang="javascrript">
	delete_url = "<?= Yii::app()->createUrl('author/comment/delete'); ?>"
</script>