<div style="margin-left:40px" id="content">
	<h1 class="title title_article-tizer" style="color:#fca100; margin-left: 40px;">Обратная связь</h1>

	<form class="form-horizontal" action="<?php echo Yii::app()->createUrl('feedback/default/send');?>" method="post">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
				<input type="text" name="email" id="inputEmail" placeholder="Email">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputEmail">Имя</label>
			<div class="controls">
				<input type="text" name="name" id="inputEmail" placeholder="Имя">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputEmail">Текст обращения</label>
			<div class="controls">
				<textarea id="inputEmail" name="text" placeholder="Email"></textarea>
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<input type="submit" name="send" class="btn btn-primary" value="Отправить"/>
			</div>
		</div>
	</form>
</div>