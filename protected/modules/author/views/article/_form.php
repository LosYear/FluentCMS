<script lang="javascript">
	url = "<?php echo Yii::app()->createUrl('author/ajax/AutorsAutoComplete'); ?>";
	tagsAutocomplete = "<?php echo Yii::app()->createUrl('author/ajax/TagsAutocomplete'); ?>";
	lang_id = "<?= $lang->id ?>"
</script>
<?php
	/* @var $this ArticleController */
	/* @var $model Article */
	/* @var $form CActiveForm */

	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/typeahead.min.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/autocomplete_fields.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerCssFile($assetsUrl . '/admin.css');

	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'article-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal', 'enctype'=>'multipart/form-data'),
	));

	echo $form->errorSummary($model);
	echo $form->errorSummary($advModel);
?>
<?php if (Yii::app()->user->isAdmin()): ?>
	<div class="form-group">
		<?= $form->label($model, 'url', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?= $form->textField($model, 'url', array('class' => 'form-control', 'readonly' => $translation)) ?>
		</div>
	</div>
<?php endif; ?>

<div class="form-group">
	<?= $form->label($model, 'title', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-8">
		<?= $form->textField($model, 'title', array('class' => 'form-control')) ?>
	</div>
</div>

<div class="form-group">
	<?= $form->label($advModel, 'annotation', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-8">
		<?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
			'model' => $advModel,
			'attribute' => 'annotation',
		)); ?>
	</div>
</div>


<div class="form-group">
	<?= $form->label($model, 'content', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-8">
		<?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
			'model' => $model,
			'attribute' => 'content',
		)); ?>
	</div>
</div>

<div class="form-group">
	<?= $form->label($advModel, 'tags', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-5">
		<div class="input-group">
			<?= $form->textField($advModel, 'tags', array('data-provider' => 'typeahead', 'class' => 'form-control', 'id' => 'tags')) ?>
			<span class="input-group-btn">
		        <button class="btn btn-default" type="button" id="addTagButton">+</button>
		      </span>
		</div>
		<?= $form->hiddenField($advModel, 'tags', array('id' => 'tags_hidden')); ?>
	</div>
	<div class="col-lg-3">
		<ul id="tags">
		</ul>
	</div>
</div>


<div class="form-group" <?php if($translation): ?>style="display:none"<?php endif; ?>>
	<?= $form->label($advModel, 'aditional_authors', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-5">
		<div class="input-group">
			<?= $form->textField($advModel, 'aditional_authors', array('data-provider' => 'typeahead', 'class' => 'form-control', 'id' => 'aditional_authors')) ?>
			<span class="input-group-btn">
		        <button class="btn btn-default" type="button" id="addAuthorButton">+</button>
		      </span>
		</div>
		<?php echo $form->hiddenField($advModel, 'aditional_authors',
			array('id' => 'aditional_authors_hidden')); ?>
	</div>
	<div class="col-lg-3">
		<ul id="authors">
		</ul>
	</div>
</div>

<?php if (Yii::app()->user->isAdmin()) { ?>
	<div class="form-group">
		<?= $form->label($advModel, 'issue_id', array('class' => 'col-lg-2 control-label', 'readonly' => $translation)) ?>
		<div class="col-lg-4">
			<?php
				$issues = array();
				$issue_model = new Issue;
				$criteria = new CDbCriteria();
				$criteria->condition = '`isOpened` = 1';
				$criteria->order = '`id` DESC';
				$tmp = $issue_model->findAll($criteria);
				foreach ($tmp as $item) {
					$issues[$item->id] = $item->number . '/' . $item->year;
				}
			?>
			<?= $form->dropDownList($advModel, 'issue_id', $issues, array('class' => 'form-control', 'readonly' => $translation)) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $form->label($model, 'status', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-4">
			<?=
				$form->dropDownList($model, 'status',
					array('1' => Yii::t('author', 'Accepted'),
						'2' => Yii::t('author', 'Pending'),
						'3' => Yii::t('author', 'Awaiting correction')), array('class' => 'form-control')) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $form->label($advModel, 'is_author', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-4">
			<?php $ch = ''; if($translation){$ch = 'return false'; } ?>
			<?= $form->checkBox($advModel, 'is_author', array('class' => 'form-control', 'readonly' => $translation, 'onclick' => $ch)) ?>
		</div>
	</div>
<?php
} else {
	$model->status = 2;
} ?>

<div class="form-group">
	<?= $form->label($advModel, 'pdf', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-4">
		<?= $form->fileField($advModel, 'pdf', array('class' => 'form-control')) ?>
	</div>
</div>

<div class="form-group">
	<?= $form->label($advModel, 'image', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-4">
		<?= $form->fileField($advModel, 'image', array('class' => 'form-control')) ?>
	</div>
</div>

<div class="form-group">
	<div class="col-lg-offset-2 col-lg-2">
		<button type="submit" class="btn btn-default" id="btnSubmit"><?= Yii::t('admin', 'Submit') ?></button>
	</div>
</div>

<?php $this->endWidget(); ?>


<script lang="javascript">
	jQuery('select[readonly] option:not(:selected)').attr('disabled',true);
</script>