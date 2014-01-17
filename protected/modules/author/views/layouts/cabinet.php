<?php Yii::app()->getModule('author'); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css"/>
	<title>Admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="page">
	<div class="header">
		<?php
			$this->widget('bootstrap.widgets.TbNavbar', array(
				'fixed' => 'top',
				'collapse' => true,
				'type' => 'inverse',
				//'class' => 'inverse',
				/*'htmlOptions' => array(
				  //'class' => 'navbar-static-top navbar-inverse',
					'style' => '.container{width:1000px}',
				),*/
				'brand' => 'Кабинет',
				'brandUrl' => Yii::app()->homeUrl,
				'items' => array(
					array(
						'class' => 'bootstrap.widgets.TbMenu',
						'items' => array(
							array(
								'label' => Yii::t('admin', 'Site'),
								'url' => Yii::app()->homeUrl,
								'icon' => 'home white',
							),
							array(
								'label' => Yii::t('AuthorModule.main', 'Dashboard'),
								'url' => Yii::app()->homeUrl,
								'icon' => 'th-large white',
							),
							array(
								'label' => Yii::t('AuthorModule.main', 'Articles'),
								'url' => Yii::app()->createUrl('author/article'),
								'icon' => 'inbox white',
							),
							array(
								'label' => Yii::t('AuthorModule.main', 'Profile'),
								'url' => Yii::app()->createUrl('author/profile/edit'),
								'icon' => 'user white',
								'items' => array(
									array(
										'label' => Yii::t('AuthorModule.main', 'Info'),
										'url' => Yii::app()->createUrl('author/profile/edit'),
										'icon' => 'info-sign'
									),
									array(
										'label' => Yii::t('AuthorModule.main', 'Photo'),
										'url' => Yii::app()->createUrl('avatar/avatar/editAvatar'),
										'icon' => 'picture'
									),
								),
							),
							array(
								'label' => Yii::t('main', 'Messages'),
								'icon' => 'envelope white',
								'url' => Yii::app()->createUrl('mailbox/message'),

							),
                            array(
                                'label' => Yii::t('admin', 'Logout'),
                                'icon' => 'off white',
                                'url' => Yii::app()->createUrl('user/user/logout'),
                            )

						),
					),
				)));?>
	</div>
	<div class="breadcrumbs">
		<?php if (isset($this->breadcrumbs)): ?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
		<?php endif ?>
	</div>
	<div class="container-fluid margin-10">
		<div class="row-fluid">
			<div class="span10 well well-small">
				<?php echo $content; ?>
			</div>
			<div class="span2 well well-small">
				<?php if (isset($this->menu)): ?>
					<?php $this->widget('bootstrap.widgets.TbMenu', array(
						'type' => 'list',
						'items' => $this->menu,
					)); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>