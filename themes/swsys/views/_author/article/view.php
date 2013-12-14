<?php
	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/comments.js', CClientScript::POS_END);
	$this->pageTitle = $model->title.' | '.Yii::app()->name;
?>
<script lang="javascript">
	new_comment = "<?php echo Yii::app()->createUrl('author/ajax/addcomment'); ?>";
	article_id = <?php echo $model->id; ?>;
	get_comments = "<?php echo Yii::app()->createUrl('author/ajax/getcomments'); ?>";
	comments_count = "<?php echo Comment::model()->count(); ?>";
</script>
<article class="main ym-clearfix">
	<div class="article">
		<aside class="article-aside">
			<div>
				<div class="article-aside-content">
					<div class="rs-carousel">
						<ul class="faces_authors">
							<?php foreach ($authors as $one) { ?>
								<li class="face">
									<?php $img = "http://placehold.it/84x122";
										if ($one['user_id'] != -1) {
											$usr = YumUser::model()->findByPk($one['user_id']);
											if($usr->avatar != NULL){
												$img = $usr->avatar;
											}
										}
									?>
									<img src="<?= $img ?>" alt="">
									<a href="<?php echo Yii::app()->createUrl('author/profile/view', array('id' => $one['id'])); ?>"><?php echo $one['name'] ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="title_article-aside first">Авторы
					<div class="expand hidden">[ + ]</div>
					<div class="tail-corner-top-right"></div>
				</div>
			</div>

			<div>
				<div class="title_article-aside">Аннотация
					<div class="expand">[ + ]</div>
				</div>
				<div class="article-aside-content" style="display: none;"><?php echo $advModel->annotation_rus; ?></div>
			</div>

			<div>
				<div class="title_article-aside">Ключевые слова
					<div class="expand">[ + ]</div>
				</div>
				<div class="article-aside-content" style="display: none;">
					<?php foreach ($tags_rus as $tag): ?>
						<a href="<?= Yii::app()->createUrl('author/article/tagged', array('tag' => $tag->id)); ?>"><?php echo $tag->info->tag ?></a>,&nbsp;
					<?php endforeach; ?>
				</div>
			</div>
		</aside>

		<ul class="breadcrumbs">
			<li><a href="<?php echo Yii::app()->homeUrl; ?>">Главная страница</a> <span class="divider">»</span></li>
			<li>
				<a href="<?php echo Yii::app()->createUrl("author/issue", array('id' => $advModel->issue_id)) ?>">Статьи</a>
				<span class="divider">»</span></li>
			<li class="active"><?php echo $model->title; ?></li>
		</ul>

		<h1 class="title title_article"><?php echo $model->title; ?></h1>

		<div class="article-content">
			<?php echo $model->content; ?>
		</div>
	</div>
	<div class="swsys-like"><span class="icon icon_like"></span><span
			id="like_text"><?php if (!$liked) : ?>Статья нравится <?php else: ?> Статья не нравится <?php endif; ?></span>

		<div class="tail-corner-top-right"></div>
	</div>

	<?php if (!Yii::app()->user->isGuest): ?>
		<div class="user-comment">
			<h3 class="title title_add-comment">Добавить комментарий
				<div class="icon icon_comment-arrowdown"></div>
			</h3>
			<div class="user-comment-editor">
				<?php $this->widget('ext.editMe.widgets.ExtEditMe', array('name' => 'comment-field',
					'toolbar' => array(
						array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat',),
						array('Link', 'Unlink'),
						array('NumberedList', 'BulletedList', '-', 'Blockquote',),
					))); ?>
				<button class="btn btn-link btn-block" style="color:orange" id="send-comment">
					<?php echo Yii::t('AuthorModule.main', 'Send'); ?>
				</button>
			</div>
		</div>
	<?php endif; ?>
	<div class="comments">
		<h3 class="title title_comments">Комментарии</h3>

		<div class="comments-list">
			<?php
				$criteria = new CDbCriteria();
				$criteria->condition = '`node_id` = :id';
				$criteria->params = array(':id' => $model->id);
				$criteria->order = '`created` DESC';

				$this->widget('zii.widgets.CListView', array(
					'dataProvider' => new CActiveDataProvider('Comment', array('criteria' => $criteria)),
					'itemView' => 'comment',
					'id' => 'comments',
					'template' => '{items}{pager}',
					'pager' =>
					array('class' => 'bootstrap.widgets.TbPager'),
					'pagerCssClass' => 'pagination pagination_comments ym-clearfix',
					'emptyText' => Yii::t('AuthorModule.main', 'There are no comments')
				)); ?>
		</div>
</article>

<script lang="javascript">
	like_url = "<?php echo Yii::app()->createUrl('author/ajax/like'); ?>";
	$('.expand').click(function () {
		el = $(this).parent().parent().children('.article-aside-content');
		if (el.is(':visible')) {
			el.hide(1000);
		}
		else {
			el.show(1000);
		}
	});
	$('.swsys-like').click(function () {
		$.ajax({
			url: like_url,
			data: {"article": article_id},
			type: "POST"
		}).done(function (data) {
				data1 = eval('(' + data + ')')
				alert(data1.msg);
				$('#like_text').html(data1.text);

			});

	});
</script>