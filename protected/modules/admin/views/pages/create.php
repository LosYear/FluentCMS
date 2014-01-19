<?php
	/* @var $this PageController */
	/* @var $model Page */

	$this->breadcrumbs = array(
		Yii::t('admin', 'Pages') => array('admin'),
		Yii::t('admin', 'Create'),
	);

	$this->menu = array(
		array('label' => Yii::t('admin', 'Manage pages'), 'url' => array('admin'), 'icon' => 'list black'),
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
							<a href="<?= Yii::app()->createUrl('admin/news/update', array('id' => $source->getTranslation($l->id)->id)) ?>"><?= strtoupper($l->title) ?></a>
						</li>
					<?php endforeach; ?>
					<?php foreach ($un as $l): ?>
						<li <?php if ($lang->id == $l->id): ?> class="active" <?php endif; ?>>
							<a href="<?= Yii::app()->createUrl('admin/news/create', array('lang' => $l->id, 'root_id' => $source->id)) ?>"><?= strtoupper($l->title) ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1><?php echo Yii::t('admin', 'Page') ?>
			<small><?php echo Yii::t('admin', 'Create') ?></small>
		</h1>
	</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'translation' => $translation)); ?>