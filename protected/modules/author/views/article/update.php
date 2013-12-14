<script lang="javascript">var mode = 'update';</script>
<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
            array('label'=>Yii::t('author','Create article'), 'url'=>array('create'), 'icon'=>'file black'),
            array('label'=>Yii::t('author', 'Manage articles'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<div class="page-header">
	<div class="translations">
		<ul class="nav nav-pills">
			<?php
				$tr = $model->translatedLanguageList();
				$un = $model->untranslatedLanguagesList();
			?>
			<?php foreach ($tr as $l): ?>
				<li <?php if($model->lang_id == $l->id):?> class="active" <?php endif; ?>>
					<a href="<?= Yii::app()->createUrl('author/article/update', array('id' => $model->getTranslation($l->id)->id)) ?>"><?= strtoupper($l->name) ?></a>
				</li>
			<?php endforeach; ?>
			<?php foreach ($un as $l): ?>
				<li>
					<a href="<?= Yii::app()->createUrl('author/article/create', array('lang' => $l->id, 'root_id' => $source->id)) ?>"><?= strtoupper($l->name) ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<h1><?php echo Yii::t('AuthorModule.admin', 'Article') ?>
		<small><?php echo Yii::t('AuthorModule.admin', 'Update') ?></small>
	</h1>
</div>

<div id="main" >
<?php echo $this->renderPartial('_form', array('model'=>$model, 'advModel'=>$advModel, 'lang' => $lang, 'translation' => $translation)); ?></div>