<?php
	/* @var $this MenuItemController */
	/* @var $model MenuItem */

	$this->breadcrumbs = array(
		Yii::t('admin', 'Menu items') => array('admin', 'id' => $model->menu_id),
		$model->title => '#',
		Yii::t('admin', 'Update'),
	);

	$this->menu = array(
		array('label' => Yii::t('admin', 'Manage menu items'), 'url' => array('admin', 'id' => $model->menu_id), 'icon' => 'list black',),
		array('label' => Yii::t('admin', 'Create menu item'), 'url' => array('create', 'id' => $model->menu_id), 'icon' => 'file black'),
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
						<a href="<?= Yii::app()->createUrl('admin/menuItem/update', array('id' => $model->getTranslation($l->id)->id)) ?>"><?= strtoupper($l->name) ?></a>
					</li>
				<?php endforeach; ?>
				<?php foreach ($un as $l): ?>
					<li>
						<a href="<?= Yii::app()->createUrl('admin/menuItem/create', array('id' => $model->menu_id, 'lang' => $l->id, 'root_id' => $source->id)) ?>"><?= strtoupper($l->name) ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<h1><?php echo Yii::t('admin', 'Menu items') ?>
			<small><?php echo Yii::t('admin', 'Update') ?></small>
		</h1>
	</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'translation' => $translation)); ?>