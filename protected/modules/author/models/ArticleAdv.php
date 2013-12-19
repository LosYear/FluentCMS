<?php
	Yii::import('application.modules.user.UserModule');
	/**
	 * This is the model class for table "article".
	 *
	 * The followings are the available columns in table 'article':
	 * @property integer $node_id
	 * @property string $title_eng
	 * @property integer $issue_id
	 * @property string $tags_rus
	 * @property string $tags_eng
	 * @property string $aditional_authors
	 * @property string $annotation_rus
	 * @property string $annotation_eng
	 */
	class ArticleAdv extends Translationable
	{
		/**
		 * Returns the static model of the specified AR class.
		 * @param string $className active record class name.
		 * @return ArticleAdv the static model class
		 */
		public static function model($className = __CLASS__)
		{
			return parent::model($className);
		}

		/**
		 * @return string the associated database table name
		 */
		public function tableName()
		{
			return 'article';
		}

		/**
		 * @return array validation rules for model attributes.
		 */
		public function rules()
		{
			// NOTE: you should only define rules for those attributes that
			// will receive user inputs.
			return array(
				array('node_id, issue_id, tags, aditional_authors, annotation, is_author', 'required'),
				array('node_id, issue_id, views, likes, is_author', 'numerical', 'integerOnly' => true),
				array('pdf', 'file', 'types' => 'pdf', 'allowEmpty' => true),
				array('image', 'EPhotoValidator', 'mimeType' => array('image/jpeg', 'image/gif', 'image/png'),
					'maxWidth' => 515,'minWidth' => 500, 'minHeight' => 170,'allowEmpty' => true),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('node_id, tags, aditional_authors, annotation, likes, views, is_author, pdf, image', 'safe', 'on' => 'search'),
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
				'article' => array(self::BELONGS_TO, 'Article', 'node_id'),
				'issue' => array(self::BELONGS_TO, 'Issue', 'issue_id'),
			);
		}

		/**
		 * @return array customized attribute labels (name=>label)
		 */
		public function attributeLabels()
		{
			return array(
				'node_id' => 'Node',
				'issue_id' => Yii::t('author', 'Issue'),
				'tags' => Yii::t('author', 'Tags'),
				'aditional_authors' => Yii::t('author', 'Additional Authors'),
				'annotation' => Yii::t('author', 'Annotation'),
				'is_author' => Yii::t('author', 'Is article written by you?'),
			);
		}

		/**
		 * Retrieves a list of models based on the current search/filter conditions.
		 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
		 */
		public function search()
		{
			// Warning: Please modify the following code to remove attributes that
			// should not be searched.

			$criteria = new CDbCriteria;

			$criteria->compare('node_id', $this->node_id);
			$criteria->compare('title_eng', $this->title_eng, true);
			$criteria->compare('issue_id', $this->issue_id);
			$criteria->compare('tags_rus', $this->tags_rus, true);
			$criteria->compare('tags_eng', $this->tags_eng, true);
			$criteria->compare('aditional_authors', $this->aditional_authors, true);
			$criteria->compare('annotation_rus', $this->annotation_rus, true);
			$criteria->compare('annotation_eng', $this->annotation_eng, true);

			return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
		}

		/**
		 * Returns popularity of current article. Max 100 points
		 * @return int Popularity
		 */

		public function getPopularity()
		{
			$criteria = new CDbCriteria();
			$criteria->select = 'MAX(`views`) AS views';
			$criteria->condition = '`issue_id` = :id';
			$criteria->params = array(':id' => $this->issue_id);

			$max = ArticleAdv::model()->find($criteria);
			$max = $max['views'];

			if ($max == 0) {
				$max = 1;
			}
			if ($this->views == 0) {
				$this->views = 1;
			}

			$views_points = (int)(($this->views / $max) * 30);


			$criteria = new CDbCriteria();
			$criteria->select = 'MAX(`likes`) AS likes';
			$criteria->condition = '`issue_id` = :id';
			$criteria->params = array(':id' => $this->issue_id);

			$max = ArticleAdv::model()->find($criteria);
			$max = $max['likes'];

			if ($max == 0) {
				$max = 1;
			}
			if ($this->likes == 0) {
				$this->likes = 1;
			}

			$likes_points = (int)(($this->likes / $max) * 70);

			return $likes_points + $views_points;
		}

		public function afterSave()
		{
			$article = $this->article;
			if (!$this->isNewRecord && $article->root_id == -1) {
				$criteria = new CDbCriteria();
				$criteria->condition = '`root_id` = :id';
				$criteria->params = array(':id' => $article->id);

				$translations = Article::model()->findAll($criteria);

				foreach ($translations as $t) {
					$adv = $t->advanced;
					$adv->is_author = $this->is_author;
					$adv->issue_id = $this->issue_id;

					$adv->save();
				}
			}

			parent::afterSave();
		}
	}