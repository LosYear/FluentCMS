<script lang="javascript">var mode = 'create';</script>
<?php
	/* @var $this ArticleController */
	/* @var $model Article */

	$this->breadcrumbs = array(
		Yii::t('AuthorModule.admin', 'Articles') => array('admin'),
		Yii::t('AuthorModule.admin', 'Create'),
	);

	$this->menu = array(
		array('label' => Yii::t('AuthorModule.admin', 'Manage articles'), 'url' => array('admin'), 'icon' => 'list black',),
	);
?>

<div class="page-header">
	<?php if ($source != null): ?>
		<div class="translations">
			<ul class="nav nav-pills">
				<?php
					$tr = $source->translatedLanguageList();
					$un = $source->untranslatedLanguagesList();
				?>
				<?php foreach ($tr as $l): ?>
					<li <?php if ($lang->id == $l->id): ?> class="active" <?php endif; ?>>
						<a href="<?= Yii::app()->createUrl('author/article/update', array('id' => $source->getTranslation($l->id)->id)) ?>"><?= strtoupper($l->name) ?></a>
					</li>
				<?php endforeach; ?>
				<?php foreach ($un as $l): ?>
					<li <?php if ($lang->id == $l->id): ?> class="active" <?php endif; ?>>
						<a href="<?= Yii::app()->createUrl('author/article/create', array('lang' => $l->id, 'root_id' => $source->id)) ?>"><?= strtoupper($l->name) ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<h1><?php echo Yii::t('AuthorModule.admin', 'Articles') ?>
		<small><?php echo Yii::t('AuthorModule.admin', 'Create') ?></small>
	</h1>
</div>

<div id="main">

	<?php echo $this->renderPartial('_form', array('model' => $model, 'advModel' => $advModel, 'lang' => $lang, 'translation' => $translation)); ?></div>