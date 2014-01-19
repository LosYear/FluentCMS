<?php
	/* @var $this MenuItemController */
	/* @var $model MenuItem */

	$this->breadcrumbs = array(
		'Menu Items' => array('index'),
		'Create',
	);

	$this->menu = array(
		array('label' => Yii::t('admin', 'Manage menu items'), 'url' => array('admin', 'id' => $model->menu_id), 'icon' => 'list black',)
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
							<a href="<?= Yii::app()->createUrl('admin/menuItem/update', array('id' => $source->getTranslation($l->id)->id)) ?>"><?= strtoupper($l->title) ?></a>
						</li>
					<?php endforeach; ?>
					<?php foreach ($un as $l): ?>
						<li <?php if ($lang->id == $l->id): ?> class="active" <?php endif; ?>>
							<a href="<?= Yii::app()->createUrl('admin/menuItem/create', array( 'id' => $model->menu_id, 'lang' => $l->id, 'root_id' => $source->id)) ?>"><?= strtoupper($l->title) ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1><?php echo Yii::t('admin', 'Menu items') ?>
			<small><?php echo Yii::t('admin', 'Create') ?></small>
		</h1>
	</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'translation' => $translation)); ?>