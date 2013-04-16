<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property integer $tour_id
 * @property string $type
 * @property string $task
 * @property string $advanced
 */
class Task extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Task the static model class
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
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tour_id, type, task, advanced', 'required'),
			array('tour_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tour_id, type, task, advanced', 'safe', 'on'=>'search'),
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
			'tour_id' => Yii::t('RushModule.admin', 'Tour'),
			'type' => Yii::t('RushModule.admin', 'Type'),
			'task' => Yii::t('RushModule.admin', 'Task'),
			'advanced' => Yii::t('RushModule.admin', 'Advanced'),
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
		$criteria->compare('tour_id',$this->tour_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('task',$this->task,true);
		$criteria->compare('advanced',$this->advanced,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Returns array of types for tasks
         */
        
        public static function types(){
            return array(
                'file' => Yii::t('RushModule.admin', 'File'),
                'question' => Yii::t('RushModule.admin', 'Question'),
            );
        }
        
        /**
         * Returns type of task
         */
        
        public static function type($id){
            $types = Task::types();
            
            $criteria = new CDbCriteria;
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $id);
            
            $type = Task::model()->find($criteria)->type;
            //echo($type);die;
            
            return $types[$type];
        }
        
        /**
         * Returns title of file
         */
         
         public static function getFileTitle($id){
           
            $criteria = new CDbCriteria;
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $id);
            
            $tmp = json_decode(Task::model()->find($criteria)->advanced, true);
            
            return $tmp["title"];
		 }
}
