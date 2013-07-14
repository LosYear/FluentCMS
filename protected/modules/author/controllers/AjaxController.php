<?php

	class AjaxController extends Controller
	{
		public function actionAutorsAutoComplete()
		{
			if (isset($_POST['query'])) {
				$author = Profile::model();

				$match = addcslashes($_POST['query'], '%_');

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

		private function tagsAutocomplete($query, $lang)
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

		public function actionTagsRusAutocomplete()
		{
			if (isset($_POST['query'])) {
				die(json_encode(array('tags' => $this->tagsAutocomplete($_POST['query'], 'ru'))));
			}
			die('');
		}

		public function actionTagsEngAutocomplete()
		{
			if (isset($_POST['query'])) {
				die(json_encode(array('tags' => $this->tagsAutocomplete($_POST['query'], 'eng'))));
			}
			die('');
		}

		public function actionLike()
		{
			if (isset($_POST['article'])){
				$model = ArticleAdv::model()->findByPk($_POST['article']);
				$model->likes++;
				$model->save();

				die(Yii::t('AuthorModule.main', 'You voted'));
			}
		}
	}