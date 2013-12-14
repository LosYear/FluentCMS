<?php

/**
 * This is the model class for table "author_profile".
 *
 * The followings are the available columns in table 'author_profile':
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $academic
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return 'author_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, email, academic, job, branch', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, name, email, academic, id, job, branch', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('authorModule.main', 'User'),
			'name' => Yii::t('authorModule.main', 'Name'),
			'email' => Yii::t('authorModule.main', 'Email'),
			'academic' => Yii::t('authorModule.main', 'Academic grade'),
			'job' => Yii::t('authorModule.main', 'Job'),
			'branch' => Yii::t('authorModule.main', 'Branch'),
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('academic',$this->academic,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}