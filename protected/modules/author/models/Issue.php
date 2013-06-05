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
	public static function model($className=__CLASS__)
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
			array('isOpened, number', 'numerical', 'integerOnly'=>true),
			array('cover', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, year, cover, isOpened, created', 'safe', 'on'=>'search'),
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
			'number' => Yii::t('author', 'Number'),
			'year' => Yii::t('author', 'Year'),
			'cover' => Yii::t('author', 'Cover'),
                        'isOpened' =>  Yii::t('author', 'Publication status'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('isOpened',$this->isOpened);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Counts amount of articles in current issue
	 * @return int the amount of articles
	 */
	public function articlesCount(){
		$criteria = new CDbCriteria();
		$criteria->condition = '`issue_id` = :id';
		$criteria->params = array(':id' => $this->id);

		return $this->count($criteria);
	}

}