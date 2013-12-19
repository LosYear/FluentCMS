<?php

	/**
	 * This is the model class for table "issue".
	 *
	 * The followings are the available columns in table 'issue':
	 * @property integer $id
	 * @property string $number
	 * @property integer $year
	 * @property string $cover
	 * @property integer $isOpened
	 * @property string $created
	 */
	class Issue extends CActiveRecord
	{
		/**
		 * Returns the static model of the specified AR class.
		 * @param string $className active record class name.
		 * @return Issue the static model class
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
			return 'issue';
		}

		/**
		 * @return array validation rules for model attributes.
		 */
		public function rules()
		{
			// NOTE: you should only define rules for those attributes that
			// will receive user inputs.
			return array(
				array('number, year, isOpened, created', 'required'),
				array('isOpened, number', 'numerical', 'integerOnly' => true),
				array('cover', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, number, year, cover, isOpened, created', 'safe', 'on' => 'search'),
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
				'articles' => array(self::HAS_MANY, 'ArticleAdv', 'issue_id'),
			);
		}

		/**
		 * @return array customized attribute labels (name=>label)
		 */
		public function attributeLabels()
		{
			return array(
				'id' => '#',
				'number' => Yii::t('author', 'Number'),
				'year' => Yii::t('author', 'Year'),
				'cover' => Yii::t('author', 'Cover'),
				'isOpened' => Yii::t('author', 'Publication status'),
				'created' => 'Created',
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

			$criteria->compare('id', $this->id);
			$criteria->compare('number', $this->number, true);
			$criteria->compare('year', $this->year);
			$criteria->compare('cover', $this->cover, true);
			$criteria->compare('isOpened', $this->isOpened);
			$criteria->compare('created', $this->created, true);

			return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
		}

		/**
		 * Counts amount of articles in current issue
		 * @return int the amount of articles
		 */
		public function articlesCount()
		{
			$criteria = new CDbCriteria();
			$criteria->condition = '`issue_id` = :id';
			$criteria->params = array(':id' => $this->id);

			return $this->count($criteria);
		}

		/**
		 * Returns all articles which related to this issue
		 * @return array
		 */
		public function getArticles()
		{
			// Getting list of articles
			$criteria = new CDbCriteria;
			$criteria->condition = 'issue_id=:id';
			$criteria->with = array('article' => array('select' => false, 'condition' => 'article.status = 1 AND article.root_id = -1', 'order' => 'created DESC'));
			$criteria->params = array(':id' => $this->id);

			$articles = ArticleAdv::model()->findAll($criteria);

			$result = array();

			foreach ($articles as $element) {
				$article = $element->article;
				$translatedArticle = $article->getTranslation(Language::getCurrentID());
				$translatedArticleAdvanced = $translatedArticle->advanced;


				$img = $element->image;
				if($img != null){
					$img = $article->id . "." . pathinfo($element->image, PATHINFO_EXTENSION);
				}
				$result[] = array(
					'id' => $translatedArticle->id,
					'title' => $translatedArticle->title,
					'annotation' => $translatedArticleAdvanced->annotation,
					'href' => $translatedArticle->url,
					'authors' => $translatedArticle->getAuthors(),
					'popularity' => $element->getPopularity(),
					'image' => $img,
				);
			}
			return $result;
		}

		/**
		 * Returns count of authors who have written articles for this issue
		 */
		public function getAuthorsCount(){
			// Getting list of articles
			$criteria = new CDbCriteria;
			$criteria->condition = 'issue_id=:id';
			$criteria->with = array('article' => array('select' => false, 'condition' => 'article.status = 1 AND article.root_id = -1', 'order' => 'created DESC'));
			$criteria->params = array(':id' => $this->id);

			$articles = ArticleAdv::model()->findAll($criteria);

			$authors_amount = array();

			foreach($articles as $article){
				$authors = $article->article->getAuthors();
				foreach($authors as $a){
					$id = $a['id'];
					$authors_amount[$id] = 1;
				}
			}

			return count($authors_amount);
		}

	}