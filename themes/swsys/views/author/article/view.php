<?php
	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/comments.js', CClientScript::POS_END);
	$this->pageTitle = $model->title . ' | ' . Yii::app()->name;
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
									<?php $img = "/themes/swsys/img/user.png";
										if ($one['user_id'] != -1) {
											$usr = YumUser::model()->findByPk($one['user_id']);
											if ($usr->avatar != NULL) {
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
				<div class="title_article-aside first"><?= Yii::t('AuthorModule.main', 'Authors') ?>
					<div class="expand hidden">[ + ]</div>
					<div class="tail-corner-top-right"></div>
				</div>
			</div>

			<div>
				<div class="title_article-aside"><?= Yii::t('AuthorModule.main', 'Abstract') ?>
					<div class="expand">[ + ]</div>
				</div>
				<div class="article-aside-content" style="display: none;"><?php echo $advModel->annotation; ?></div>
			</div>

			<div>
				<div class="title_article-aside"><?= Yii::t('AuthorModule.main', 'Keywords') ?>
					<div class="expand">[ + ]</div>
				</div>
				<div class="article-aside-content" style="display: none;">
					<?php foreach ($tags_rus as $tag): ?>
						<a href="<?= Yii::app()->createUrl('author/article/tagged', array('tag' => $tag->tag_id)); ?>"><?php echo $tag->info->tag ?></a>,&nbsp;
					<?php endforeach; ?>
				</div>
			</div>
			
			<div>
				<div class="title_article-aside"><?= Yii::t('AuthorModule.main', 'Extra') ?>
				</div>
				<div class="article-aside-content">
					<?php
						$date = DateTime::createFromFormat("Y-m-d", $issue_info->year);
						$year = $date->format("Y");
						$month = Yii::t('date', $date->format("F"));
						$number = $issue_info->number;
					?>
					<p>
						<?= Yii::t('AuthorModule.main', 'The article was published in issue') ?> <a href="<?= Yii::app()->createUrl('author/issue', array('id' => $issue_info->id,)) ?>">№<?=$number ?></a> <?= Yii::t('AuthorModule.main', 'which is dated by') ?> <?= Yii::app()->dateFormatter->formatDateTime(strtotime($date->format("d F Y")), 'long', null); ?>
					</p><br/>
					<?php if ($advModel->pdf != null): ?>
						<a href="<?= Yii::app()->createUrl('author/article/downloadPDF', array('id' => $advModel->node_id)) ?>"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;<?= Yii::t('AuthorModule.main', 'Download article in PDF') ?></a>
					<?php endif;?>
					
					<a target="_blank" href="<?= Yii::app()->createUrl('author/article/print', array('id'=>$advModel->node_id)) ?>"><span class="glyphicon glyphicon-print"></span>&nbsp;<?= Yii::t('AuthorModule.main', 'Printable version') ?></a>

					<div class="url">
						<label><?= Yii::t('AuthorModule.main', 'Link to this article') ?></label>
						<input type="text" class="form-control input-sm" readonly value="<?= Yii::app()->homeUrl.MultilangHelper::addLangToUrl($model->url.'.html') ?>" onclick="this.select()"/>
					</div>
				</div>
			</div>
		</aside>

		<ul class="breadcrumbs">
			<li><a href="<?php echo Yii::app()->homeUrl; ?>"><?= Yii::t('AuthorModule.main', 'Home') ?></a> <span class="divider">»</span></li>
			<li>
				<a href="<?php echo Yii::app()->createUrl("author/issue", array('id' => $advModel->issue_id)) ?>"><?= Yii::t('AuthorModule.main', 'Articles') ?></a>
				<span class="divider">»</span></li>
			<li class="active"><?php echo $model->title; ?></li>
		</ul>

		<h1 class="title title_article"><?php echo $model->title; ?></h1>

		<div class="article-content">
			<?php echo $model->content; ?>
		</div>
	</div>
	<div class="swsys-like"><span class="icon icon_like"></span><span
			id="like_text"><?php if (!$liked) : ?><?= Yii::t('AuthorModule.main', 'Like') ?> <?php else: ?> <?= Yii::t('AuthorModule.main', 'Unlike') ?> <?php endif; ?></span>

		<div class="tail-corner-top-right"></div>
	</div>

	<?php if (!Yii::app()->user->isGuest): ?>
		<div class="user-comment">
			<h3 class="title title_add-comment"><?= Yii::t('AuthorModule.main', 'Write a comment') ?>
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
		<h3 class="title title_comments"><?= Yii::t('AuthorModule.main', 'Comments') ?></h3>

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
<script src="http://c.fzilla.com/1291523190-jpaginate.js"></script>  
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
$(document).ready(function(){  
    $(".article-content").jPaginate({items:10, next:"<?= Yii::t('AuthorModule.main', 'Next') ?>", previous:"<?= Yii::t('AuthorModule.main', 'Previous') ?>", position:"both", cookies:false});
    $(".goto").click(function(){$(window).scrollTop(0)});                   
}); 

</script>