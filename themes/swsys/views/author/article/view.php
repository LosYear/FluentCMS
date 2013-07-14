<article class="main ym-clearfix">
	<div class="article">
		<aside class="article-aside">
			<div>
				<div class="article-aside-content">
					<div class="rs-carousel">
						<ul class="faces_authors">
							<?php foreach ($authors as $one) { ?>
								<li class="face">
									<img src="http://placehold.it/84x122" alt="">
									<a href="" class="link"><?php echo $one['name'] ?></a>
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
						<a href="#"><?php echo $tag->info->tag ?></a>,&nbsp;
					<?php endforeach; ?>
				</div>
			</div>
		</aside>

		<ul class="breadcrumbs">
			<li><a href="<?php echo Yii::app()->homeUrl; ?>">Главная страница</a> <span class="divider">»</span></li>
			<li><a href="<?php echo Yii::app()->createUrl("author/issue", array('id' => $advModel->issue_id)) ?>">Статьи</a> <span class="divider">»</span></li>
			<li class="active"><?php echo $model->title; ?></li>
		</ul>

		<h1 class="title title_article"><?php echo $model->title; ?></h1>

		<div class="article-content">
			<?php echo $model->content; ?>
		</div>
	</div>
	<div class="swsys-like"><span class="icon icon_like"></span> Статья нравится
		<div class="tail-corner-top-right"></div>
	</div>
	<!--<div class="user-comment">
		<h3 class="title title_add-comment">Добавить комментарий
			<div class="icon icon_comment-arrowdown"></div>
		</h3>
		<div class="user-comment-editor">

		</div>
	</div>
	<div class="comments">
		<h3 class="title title_comments">Комментарии</h3>

		<div class="comments-list">
			<div class="comment-item">
				<div class="comment-date">26 сентября 2012 в 14:51</div>
				<div class="comment-content">Сформулирована задача синтеза механизма управления эволюцией
					организационно-технологической
					системы, использующей способность человека к самоорганизации. Разработана модель
					функционирования системы, содер-жащей агентов, способных к самоорганизации
				</div>
				<div class="comment-author">
					<span class="icon icon_person"></span><a class="link" href="">Палюх Б.В.</a>
				</div>
				<hr class="hr">
			</div>
			<div class="comment-item">
				<div class="comment-date">26 сентября 2012 в 14:51</div>
				<div class="comment-content">Сформулирована задача синтеза механизма управления эволюцией
					организационно-технологической
					системы, использующей способность человека к самоорганизации. Разработана модель
					функционирования системы, содер-жащей агентов, способных к самоорганизации
				</div>
				<div class="comment-author">
					<span class="icon icon_person"></span><a class="link" href="">Палюх Б.В.</a>
				</div>
				<hr class="hr">
			</div>
		</div>
		<div class="pagination pagination_comments ym-clearfix">
			<ul>
				<li class="first"><a href="#"> ←
						<small>Назад</small>
					</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li class="active"><span>3</span></li>
				<li><a href="#">4</a></li>
				<li class="etc">...</li>
				<li><a href="#">244</a></li>
				<li class="last"><a href="#">
						<small>Вперёд</small>
						→ </a></li>
			</ul>
		</div>
	</div>-->
</article>

<script lang="javascript">
	article_id = <?php echo $model->id; ?>;
	like_url = "<?php echo Yii::app()->createUrl('author/ajax/like'); ?>";
	$('.expand').click(function () {
		el = $(this).parent().parent().children('.article-aside-content');
		if(el.is(':visible')){
			el.hide(1000);
		}
		else{
			el.show(1000);
		}
	});
	can_like = true;
	$('.swsys-like').click(function(){
		if (can_like){
			$.ajax({
				url: like_url,
				data: {"article" : article_id},
				type: "POST"
			}).done(function(data){
					alert(data);
				});
			can_like = false;
		}
	});
</script>