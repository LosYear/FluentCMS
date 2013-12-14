<?php
	/* @var $this BlockController */
	/* @var $model Block */

	$this->breadcrumbs = array(
		Yii::t('admin', 'Blocks') => array('admin'),
		$model->title => '#',
		Yii::t('admin', 'Update'),
	);

	$this->menu = array(
		array('label' => Yii::t('admin', 'Manage blocks'), 'url' => array('admin'), 'icon' => 'list black',),
		array('label' => Yii::t('admin', 'Create block'), 'url' => array('create'), 'icon' => 'file black'),
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
						<a href="<?= Yii::app()->createUrl('admin/blocks/update', array('id' => $model->getTranslation($l->id)->id)) ?>"><?= strtoupper($l->name) ?></a>
					</li>
				<?php endforeach; ?>
				<?php foreach ($un as $l): ?>
					<li>
						<a href="<?= Yii::app()->createUrl('admin/blocks/create', array('lang' => $l->id, 'root_id' => $source->id)) ?>"><?= strtoupper($l->name) ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<h1><?php echo Yii::t('admin', 'Blocks') ?>
			<small><?php echo Yii::t('admin', 'Update') ?></small>
		</h1>
	</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'translation' => $translation)); ?>