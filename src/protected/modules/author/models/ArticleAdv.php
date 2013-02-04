<?php

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
class ArticleAdv extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleAdv the static model class
	 */
	public static function model($className=__CLASS__)
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
			array('node_id, title_eng, issue_id, tags_rus, tags_eng, aditional_authors, annotation_rus, annotation_eng', 'required'),
			array('node_id, issue_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('node_id, title_eng, issue_id, tags_rus, tags_eng, aditional_authors, annotation_rus, annotation_eng', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'node_id' => 'Node',
			'title_eng' => Yii::t('author', 'Title English'),
			'issue_id' => Yii::t('author', 'Issue'),
			'tags_rus' => Yii::t('author', 'Tags'),
			'tags_eng' => Yii::t('author', 'Tags English'),
			'aditional_authors' => Yii::t('author', 'Additional Authors'),
			'annotation_rus' => Yii::t('author', 'Annotation'),
			'annotation_eng' => Yii::t('author', 'Annotation English'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('node_id',$this->node_id);
		$criteria->compare('title_eng',$this->title_eng,true);
		$criteria->compare('issue_id',$this->issue_id);
		$criteria->compare('tags_rus',$this->tags_rus,true);
		$criteria->compare('tags_eng',$this->tags_eng,true);
		$criteria->compare('aditional_authors',$this->aditional_authors,true);
		$criteria->compare('annotation_rus',$this->annotation_rus,true);
		$criteria->compare('annotation_eng',$this->annotation_eng,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}