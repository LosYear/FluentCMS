<?php
	/* @var $this IssueController */
	/* @var $dataProvider CActiveDataProvider */
?>
<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */
?>
<div id="main" class="main">
	<div class="ym-column linearize-level-1">
		<aside class="ym-col1">
			<div class="block_aside block_nomer-info">
				<div class="inner">
					<h2 class="title title_nomer-info">Текущий выпуск:</h2>

					<div class="nomer-stats ym-clearfix">
						<div class="nomer-caption">
							<div class="nomer-caption-spoiler">cвежий номер</div>
							<div class="nomer-caption-year"><?php echo $new_issue['year'] ?></div>
							<div class="nomer-caption-month"><?php echo $new_issue['month'] ?></div>
						</div>

						<div class="nomer-stats-item">
							<div class="value"><?php echo $new_issue['articles'] ?></div>
							<div class="property">СТАТЕЙ</div>
						</div>


						<div class="nomer-stats-item">
							<div class="value"><?php echo $new_issue['authors_amount'] ?></div>
							<div class="property">АВТОРОВ</div>
						</div>


						<div class="nomer-stats-item">
							<div class="value">X</div>
							<div class="property">ИНТЕРЕС</div>
						</div>


					</div>


					<h2 class="title title_nomer-info">Темы номера:</h2>

					<div class="block_toc">

						<?php foreach ($new_issue['content'] as $el): ?>
							<dl>
								<dt><span style="left:<?php $per = 100-$el['popularity']; if($per>75): $per = 75; endif; echo $per; ?>%"></span><?php echo $el['popularity'] ?>
								</dt>
								<dd class="pop"><div class="pop-inner"><?php echo $el['title'] ?></div></dd>
							</dl>
						<?php endforeach; ?>
					</div>
				</div>
			</div>


			<div class="block_aside block_archive">
				<h2 class="title_block_aside">Архив
					<div class="tail-corner-left-down"></div>
				</h2>
				<div class="inner">
					<?php $active = 'active';
						foreach ($new_issue['archive'] as $key => $year) : ?>
							<div class="archive-year-item ym-clearfix">
								<div class="archive-year-label <?php echo $active;
									$active = '' ?>"><?php echo $key ?></div>
								<div class="archive-months-list">
									<?php foreach ($year as $key_2 => $month): ?>
										<div class="archive-month-item ym-clearfix">
											<div class="archive-month-label"><?php echo $key_2 ?>:</div>
											<div class="archive-items">
												<?php foreach ($month as $number => $el): ?>
													<a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $el->id,)); ?>"
													   class="link">№<?php echo $number ?></a>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endforeach; ?>
				</div>
				<div class="title_block_aside">
					<div class="tail-corner-top-left-gray"></div>
				</div>
			</div>
			<div class="block_aside block_contacts">
				<div class="inner" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<b>Как связаться с <a href="<?php echo Yii::app()->homeUrl.'/contacts.html' ?>">редакцией</a></b>

					<ul>
						<li><b>Телефон:</b> <span itemprop="telephone">(4822) 39-42-77</span></li>
						<li><b>Факс:</b> <span>(4822) 39-40-00</span></li>
						<li><b>Адрес:</b>
							<span itemprop="postalCode">170024</span>,
							<span itemprop="addressLocality">г. Тверь</span>,
							<span itemprop="streetAddress">проспект 50 лет Октября, 3 А</span></li>
						<li><b>Электронная почта:</b>
							<a itemprop="email" href="mailto:red@cps.tver.ru">red@cps.tver.ru</a>,
							<a itemprop="email" href="mailto:info@cps.tver.ru">info@cps.tver.ru</a></li>
					</ul>
				</div>
			</div>
		</aside>
		<div class="ym-col3">
			<div class="ym-cbox">
				<div class="article-inner">
					<?php foreach ($new_issue['content'] as $element) { ?>
						<div class="article-tizer-item">
							<h3 class="title title_article-tizer"><a
									href="<?php echo Yii::app()->createUrl($element['href']); ?>"><?php echo $element['title']; ?> </a>
							</h3>

							<div class="article-tizer-authors">
								<?php foreach ($element['authors'] as $author) { ?>
									<span class="icon icon_person"></span>
									<a class="link" href="<?php echo Yii::app()->createUrl('author/profile/view', array('id'=>$author['id'])); ?>"><?php echo $author['name'] ?></a>
								<?php } ?>
							</div>
							<div class="article-tizer-content">
								<?php echo $element['annotation']; ?>
							</div>
							<hr class="hr">
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="cross-articles-nav">
				<div class="cross-articles-nav-prev">
					<?php if ($new_issue['previous_issue'] != -1): ?>
						<strong>←</strong>
						<a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $new_issue['previous_issue'],)); ?>">ПРЕДЫДУЩИЙ
							ВЫПУСК</a>
					<?php endif; ?>
				</div>
				<div class="cross-articles-nav-active">
					<strong>Выпуск № <?php echo $new_issue['number']; ?></strong>
					<small><?php echo $new_issue['date']; ?></small>
				</div>
				<div class="cross-articles-nav-next">
					<?php if ($new_issue['next_issue'] != -1): ?>
						<a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $new_issue['next_issue'],)); ?>">СЛЕДУЮЩИЙ
							ВЫПУСК</a> <strong>→</strong>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>