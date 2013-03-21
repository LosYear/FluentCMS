<?php

/**
 * This is the model class for table "tour".
 *
 * The followings are the available columns in table 'tour':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $category_id
 * @property string $type
 * @property string $from
 * @property string $till
 */
class Tour extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tour the static model class
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
		return 'tour';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, category_id, type, from, till', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, category_id, type, from, till', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('RushModule.admin', 'Name'),
			'description' => Yii::t('RushModule.admin', 'Description'),
			'category_id' => Yii::t('RushModule.admin', 'Category'),
			'type' => Yii::t('RushModule.admin', 'Type'),
			'from' => Yii::t('RushModule.admin', 'From'),
			'till' => Yii::t('RushModule.admin', 'Till'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('till',$this->till,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Return array of types for tour
         * 
         */
        
        public static function types(){
            return array(
                'test' => Yii::t('RushModule.admin', 'Test'),
                'full' => Yii::t('RushModule.admin', 'Full'),
            );
        }
        
        /**
         * Returns array of tours for dropdown
         */
        
        public static function dropDown(){
            $result = array();
            
            $model = Tour::model();
            
            $criteria = new CDbCriteria();
            $criteria->order = '`name`';
            
            $all = $model->findAll($criteria);
            
            foreach ($all as $el) {
                $result[$el->id] = $el->name;
            }
            
            return $result;
        }
        
        /**
         * Checks the status of tour
         */
        
        public static function isActive($id){
            $model = Tour::model();
            $criteria = new CDbCriteria;
            $criteria->condition = '`from` <= NOW() AND `till` > NOW() AND `id` = :id';
            $criteria->params = array('id'=>$id);
            
            if($model->count($criteria) > 0){
                return true;
            }
            return false;
        }
        
        /**
         * Returns current tour category
         */
        
        public static function getCategory($id){
            $model = Tour::model();
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $id);
            
            return $model->find($criteria)->category_id;
        }
        
        /**
         * Returns Tour type
         */
        
        public static function getType($id, $full = false){
            $model = Tour::model();
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $id);
            
            if($full){
                $tmp = Tour::types();
                return $tmp[$model->find($criteria)->type];
            }
            return $model->find($criteria)->type;
        }
        
        /**
         * Returns tour's title
         */
        
        public static function title($id){
            $model = Tour::model();
            $criteria = new CDbCriteria;
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $id);
            
            $result = $model->find($criteria);
            
            return $result->name;
        }
}