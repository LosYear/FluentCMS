<?php
	/* @var $this NewsController */
	/* @var $model News */

	$this->breadcrumbs = array(
		Yii::t('admin', 'News') => array('admin'),
		$model->title => '#',
		Yii::t('admin', 'Update'),
	);

	$this->menu = array(
		array('label' => Yii::t('admin', 'Manage news'), 'url' => array('admin'), 'icon' => 'list black',),
		array('label' => Yii::t('admin', 'Create news'), 'url' => array('create'), 'icon' => 'file black'),
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
					<li <?php if ($model->lang_id == $l->id): ?> class="active" <?php endif; ?>>
						<a href="<?= Yii::app()->createUrl('admin/news/update', array('id' => $model->getTranslation($l->id)->id)) ?>"><?= strtoupper($l->title) ?></a>
					</li>
				<?php endforeach; ?>
				<?php foreach ($un as $l): ?>
					<li>
						<a href="<?= Yii::app()->createUrl('admin/news/create', array('lang' => $l->id, 'root_id' => $source->id)) ?>"><?= strtoupper($l->title) ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<h1><?php echo Yii::t('admin', 'News') ?>
			<small><?php echo Yii::t('admin', 'Update') ?></small>
		</h1>
	</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'translation' => $translation)); ?>