<?php

/**
 * This is the model class for table "poll".
 *
 * The followings are the available columns in table 'poll':
 * @property integer $id
 * @property integer $node_id
 * @property integer $isLimited
 * @property string $from
 * @property string $till
 */
class Poll extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Poll the static model class
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
		return 'poll';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('node_id, isLimited, from, till', 'required'),
			array('node_id, isLimited', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, node_id, isLimited, from, till', 'safe', 'on'=>'search'),
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
			'node_id' => 'Node',
			'isLimited' => Yii::t('PollModule.admin', 'Time Limit'),
			'from' => Yii::t('PollModule.admin', 'From'),
			'till' => Yii::t('PollModule.admin', 'Till'),
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
		$criteria->compare('node_id',$this->node_id);
		$criteria->compare('isLimited',$this->isLimited);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('till',$this->till,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getIdByNode($node_id){
            return Poll::model()->find('`node_id` = :id', array(':id' => $node_id))->id;
        }
}