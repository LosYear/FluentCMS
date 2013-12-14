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
class Page extends Node
{
        public $type = 'page';

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
			array('author, updater', 'numerical', 'integerOnly'=>true),
			array('updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, title, content, author, created, updated, updater, url, status', 'safe', 'on'=>'search'),
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
			'id' => '#',
			'type' => Yii::t('admin', 'Type'),
			'title' => Yii::t('admin', 'Title'),
			'content' => Yii::t('admin', 'Content'),
			'author' => Yii::t('admin', 'Author'),
			'created' => Yii::t('admin', 'Created'),
			'updated' => Yii::t('admin', 'Updated'),
			'updater' => Yii::t('admin','Updater'),
			'url' => Yii::t('admin','Url'),
			'status' => Yii::t('admin','Status'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('type','page',true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('author',$this->author);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updater',$this->updater);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('root_id',-1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}