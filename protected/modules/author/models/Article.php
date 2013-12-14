<?php

	/**
	 * This is the model class for table "node".
	 *
	 * The followings are the available columns in table 'node':
	 * @property integer $id
	 * @property string $type
	 * @property string $title
	 * @property string $content
	 * @property integer $author
	 * @property string $created
	 * @property string $updated
	 * @property integer $updater
	 * @property string $url
	 * @property string $status
	 */
	class Article extends Translationable
	{
		/**
		 * Returns the static model of the specified AR class.
		 * @param string $className active record class name.
		 * @return Article the static model class
		 */

		public $type = 'author/article';

		public $issue_id;


		public static function model($className = __CLASS__)
		{
			return parent::model($className);
		}

		/**
		 * @return string the associated database table name
		 */
		public function tableName()
		{
			return 'node';
		}

		/**
		 * @return array validation rules for model attributes.
		 */
		public function rules()
		{
			// NOTE: you should only define rules for those attributes that
			// will receive user inputs.
			return array(
				array('type, title, content, author, created, url, status', 'required'),
				array('author, updater', 'numerical', 'integerOnly' => true),
				array('updated', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, type, title, content, author, created, updated, updater, url, status, issue_id', 'safe', 'on' => 'search'),
			);
		}

		/**
		 * @return array relational rules.
		 */
		public function relations()
		{
			// NOTE: you may need to adjust the relation name and the related
			// class name for the relations automatically generated below.
			return array(
				'advanced' => array(self::HAS_ONE, 'ArticleAdv', 'node_id'),
				'authors' => array(self::HAS_MANY, 'ArticleAuthors', 'node_id'),
			);
		}

		/**
		 * @return array customized attribute labels (name=>label)
		 */
		public function attributeLabels()
		{
			return array(
				'id' => 'ID',
				'type' => 'Type',
				'title' => Yii::t('author', 'Title'),
				'content' => Yii::t('author', 'Content'),
				'author' => 'Author',
				'created' => 'Created',
				'updated' => 'Updated',
				'updater' => 'Updater',
				'url' => 'Url',
				'status' => Yii::t('author', 'Status'),
			);
		}

		/**
		 * Retrieves a list of models based on the current search/filter conditions.
		 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
		 */
		public function search()
		{
			// Magic begins here. Don't touch it

			$criteria = new CDbCriteria;


			$criteria->compare('id', $this->id);
			$criteria->compare('root_id', '-1', true);
			$criteria->compare('type', 'author/article', false);
			$criteria->compare('title', $this->title, true);
			$criteria->compare('content', $this->content, true);
			$criteria->compare('created', $this->created, true);
			$criteria->compare('updated', $this->updated, true);
			$criteria->compare('updater', $this->updater);
			$criteria->compare('url', $this->url, true);
			$criteria->compare('status', $this->status, true);
			$criteria->compare('advanced.issue_id', $this->issue_id, true);
			$criteria->group = 't.id';
			$criteria->order = '`created` DESC';
			$criteria->with = array('advanced');

			$author = new CDbCriteria;

			if (!Yii::app()->user->isAdmin()) {
				$author->compare('author', Yii::app()->user->id, false);
			}

			$author->with = array(
				'authors'
			);
			$author->together = true;
			$author->condition = 'author = :id OR authors.author_id = :id';
			$author->params = array(':id' => Yii::app()->user->id);

			$author->mergeWith($criteria, 'AND');

			$sort = new CSort();
			$sort->attributes = array(
				'title',
				'url',
				'created',
				'status',
				'issue_id' => array(
					'asc' => 'advanced.issue_id',
					'desc' => 'advanced.issue_id DESC',
				),

			);

			return new CActiveDataProvider($this, array(
				'criteria' => $author,
				'sort' => $sort,
				'pagination' => array(
					'pageSize' => 5,
				),
			));
		}

		/**
		 * Executes after save
		 * Synchronises all translations with original
		 *
		 */

		public function afterSave()
		{
			if (!$this->isNewRecord && $this->root_id == -1) {
				$criteria = new CDbCriteria();
				$criteria->condition = '`root_id` = :id';
				$criteria->params = array(':id' => $this->id);

				$translations = Article::model()->findAll($criteria);

				foreach ($translations as $t) {
					$t->url = $this->url;
					$t->status = $this->status;
					$t->save();
				}
			}

			parent::afterSave();
		}

		/**
		 * Returns list of authors related to the article
		 * @return array
		 */

		public function getAuthors()
		{
			$authors = array();

			$id = $this->id;
			if ($this->root_id != -1) {
				$id = $this->root_id;
			}

			$criteria = new CDbCriteria();
			$criteria->condition = '`node_id` = :id';
			$criteria->params = array(':id' => $id);

			$relations = ArticleAuthors::model()->findAll($criteria);

			foreach ($relations as $one) {
				$criteria = new CDbCriteria();
				$criteria->condition = '`id` = :id';
				$criteria->params = array(':id' => $one->author_id);

				$info['id'] = $one->author_id;

				$author = Profile::model()->find($criteria);

				$info['name'] = $author->name;
				$info['user_id'] = $author->user_id;
				$authors[] = $info;
			}

			if ($this->advanced->is_author == 1) {
				$criteria = new CDbCriteria();
				$criteria->condition = '`user_id` = :id';
				$criteria->params = array(':id' => $this->author);

				$author = Profile::model()->find($criteria);

				$info['name'] = $author->name;
				$info['user_id'] = $author->user_id;
				$info['id'] = $author->id;

				$a = array();
				$a[] = $info;
				$authors = array_merge($a, $authors);
			}

			return $authors;
		}

		/**
		 * Returns list of tags related for current language to article
		 * @return array
		 */

		public function getTags()
		{
			$criteria = new CDbCriteria();
			$criteria->condition = '`node_id` = :id';
			$criteria->params = array(':id' => $this->id);

			$tags = ArticleTags::model()->findAll($criteria);

			$tags_array = array();

			foreach ($tags as $tag) {
				if ($tag->info->lang == $this->lang_id) {
					$tags_array[] = $tag;
				}
			}

			return $tags_array;
		}

		/**
		 * Increments views count in database
		 */
		public function incrementViews()
		{
			$a = $this->advanced;
			$a->views++;
			$a->save();
		}

		/**
		 * Checks whether current user has liked the article
		 * @return bool
		 */
		public function isLiked()
		{
			$id = $this->id;
			if($this->root_id != -1){
				$id = $this->root_id;
			}
			if (Yii::app()->user->isGuest) {
				$fav = Yii::app()->session['favorite'];
				if (isset($fav[$id]) && $fav[$id]) {
					return true;
				}
			} else {
				$criteria = new CDbCriteria();
				$criteria->condition = '`node_id` = :article AND `user_id` = :user';
				$criteria->params = array(':article' => $id, ':user' => Yii::app()->user->id);

				if (ArticleVote::model()->count($criteria) > 0) {
					return true;
				}
			}

			return false;
		}
	}