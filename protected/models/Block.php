<?php

/**
 * This is the model class for table "block".
 *
 * The followings are the available columns in table 'block':
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $content
 * @property string $name
 * @property integer $author
 * @property string $created
 * @property string $updated
 * @property integer $updater
 * @property integer $status
 */
class Block extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Block the static model class
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
		return 'block';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, title, content, author, created, status, name', 'required'),
			array('author, updater, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, title, content, name, author, created, updated, updater, status', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('admin', '#'),
			'type' => Yii::t('admin', 'Type'),
			'title' => Yii::t('admin', 'Title'),
			'content' => Yii::t('admin', 'Content'),
			'name' => Yii::t('admin', 'Name'),
			'author' => Yii::t('admin', 'Author'),
			'created' => Yii::t('admin', 'Created'),
			'updated' => Yii::t('admin', 'Updated'),
			'updater' => Yii::t('admin', 'updater'),
			'status' => Yii::t('admin', 'Status'),
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('author',$this->author);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updater',$this->updater);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}