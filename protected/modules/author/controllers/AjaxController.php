<?php

	class AjaxController extends Controller
	{
		public function actionAutorsAutoComplete()
		{
			if (isset($_REQUEST['query'])) {
				$author = Profile::model();

				$match = addcslashes($_REQUEST['query'], '%_');

				$criteria = new CDbCriteria();
				$criteria->condition = "name LIKE :name";
				$criteria->params = array(':name' => "%$match%");

				$authors = $author->findAll($criteria);

				$all = array();

				foreach ($authors as $el) {
					$tmp = array();
					$tmp['label'] = $el->name;
					$tmp['value'] = $el->id;

					$all[] = $tmp;
				}

				$result['authors'] = $all;

				die(json_encode($result));
			}
			die('');
		}

		private function findTag($query, $lang)
		{
			$model = Tag::model();

			$match = addcslashes($query, '%_');

			$criteria = new CDbCriteria();
			$criteria->condition = '`tag` LIKE :tag AND `lang`=:lang';
			$criteria->params = array(':tag' => "%$match%", ':lang' => $lang);

			$tags = $model->findAll($criteria);

			$all = array();
			foreach ($tags as $tag) {
				$tmp['label'] = $tag->tag;
				$tmp['value'] = $tag->id;

				$all[] = $tmp;
			}

			return $all;
		}

		public function actionTagsAutocomplete()
		{
			if (isset($_REQUEST['query'])) {
				die(json_encode(array('tags' => $this->findTag($_POST['query'], $_POST['lang']))));
			}
			die('');
		}

		public function actionLike()
		{
			if (isset($_REQUEST['article'])) {
				$article_id = Article::model()->findByPk($_REQUEST['article'])->getTranslation(Language::defaultID())->id;
				if (Yii::app()->user->isGuest){
					// User is guest. Session is used
					$voted = Yii::app()->session['favorite'];
					if(isset($voted[$article_id])){
						unset($voted[$article_id]);
						Yii::app()->session['favorite'] = $voted;

						$model = ArticleAdv::model()->findByPk($article_id);
						$model->likes--;
						$model->save();

						die(json_encode(array('msg' => Yii::t('AuthorModule.main', 'Article is unliked'), 'text' => Yii::t('AuthorModule.main', 'Like'))));
					}

					$voted[$article_id] = true;
					Yii::app()->session['favorite'] = $voted;
				}
				else{
					// Checking on ability of voting
					$criteria = new CDbCriteria();
					$criteria->condition = '`node_id` = :article AND `user_id` = :user';
					$criteria->params = array(':article' => $article_id, ':user' => Yii::app()->user->id);

					if (ArticleVote::model()->count($criteria) > 0){
						$vote = ArticleVote::model()->find($criteria);
						$vote->delete();

						$model = ArticleAdv::model()->findByPk($_POST['article']);
						$model->likes--;
						$model->save();
						die(json_encode(array('msg' => Yii::t('AuthorModule.main', 'Article is unliked'), 'text' => Yii::t('AuthorModule.main', 'Like'))));
					}

					$model = new ArticleVote;
					$model->user_id = Yii::app()->user->id;
					$model->node_id = $_POST['article'];
					$model->save();

				}

				$model = ArticleAdv::model()->findByPk($_POST['article']);
				$model->likes++;
				$model->save();

				die(json_encode(array('msg' => Yii::t('AuthorModule.main', 'You voted'), 'text' => Yii::t('AuthorModule.main', 'Unlike'))));
			}
			else{
				echo "Not enought data";
			}
		}

		public function actionAddComment()
		{
			if (isset($_REQUEST['comment'])) {
				$model = new Comment;
				$model->node_id = $_POST['id'];
				$model->author_id = Yii::app()->user->id;
				$model->comment = $_POST['comment'];
				$model->parent_id = 0;

				if ($model->save()) {
					die(Yii::t('AuthorModule.main', 'Comment added'));
				} else {
					die('error');
				}
			}

		}

		public function actionGetComments()
		{
			if (isset($_POST['page'])) {
				$criteria = new CDbCriteria();
				$criteria->condition = '`node_id` = :id';
				$criteria->params = array(':id' => $_POST['id']);
				$criteria->limit = 10;
				$criteria->order = '`created` DESC';
				$criteria->offset = ($_POST['page'] - 1) * 10;

				$this->renderPartial('comments', array('data' => Comment::model()->findAll($criteria)));

			}

		}

		public function actionProfile()
		{
			if (isset($_POST['query'])) {
				$model = Profile::model();

				$match = addcslashes($_POST['query'], '%_');

				$criteria = new CDbCriteria();
				$criteria->condition = '`name` LIKE :name AND `user_id` = -1';
				$criteria->params = array(':name' => "%$match%");

				$profiles = $model->findAll($criteria);

				$all = array();
				foreach ($profiles as $profile) {
					$tmp['label'] = $profile->name;
					$tmp['value'] = $profile->id;
					$tmp['email'] = $profile->email;
					$tmp['academy'] = $profile->academic;

					$all[] = $tmp;
				}

				die(json_encode(array('profiles' => $all)));
			}
		}

	}