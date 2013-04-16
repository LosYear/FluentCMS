<?php

/**
 * This is the model class for table "menu_item".
 *
 * The followings are the available columns in table 'menu_item':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string $title
 * @property string $href
 * @property string $type
 * @property string $condition_name
 * @property integer $condition_denial
 * @property integer $order
 * @property integer $status
 */
class MenuItem extends CActiveRecord
{
    
        private $_items;
        private $_result;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuItem the static model class
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
		return 'menu_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, menu_id, title, href, type, status', 'required'),
			array('parent_id, menu_id, condition_denial, order, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, menu_id, title, href, type, condition_name, condition_denial, order, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'parent_id' => Yii::t('admin', 'Parent'),
			'menu_id' => 'Menu',
			'title' => Yii::t('admin', 'Title'),
			'href' => Yii::t('admin', 'Link'),
			'type' => Yii::t('admin', 'Type'),
			'condition_name' => Yii::t('admin', 'Condition'),
			'condition_denial' => Yii::t('admin', 'Condition Denial'),
			'order' => Yii::t('admin', 'Order'),
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('href',$this->href,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('condition_name',$this->condition_name,true);
		$criteria->compare('condition_denial',$this->condition_denial);
		$criteria->compare('order',$this->order);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /*  
         * Forming tree of elements.
         */
        
        private function formTree($parent_id, $level) { 
            if (isset($this->_items[$parent_id])) { 
                foreach ($this->_items[$parent_id] as $value) {
                    $level++;
                    
                    $title = '';
                    for ( $i = 0; $i<$level; $i++){
                        $title .= '-';
                    }
                    $title .= ' '.$value->title;
                    
                    
                    $this->_result[$value->id] = $title;
                    
                    $this->formTree($value->id, $level); 
                    $level--;
                } 
            } 
        } 
        
        /* 
         * Returns array of elements for combobox
         * [id] = [title]
         */
        
        public function itemsCombo(){
            
            $criteria=new CDbCriteria;
            $criteria->condition='menu_id=:id';
            $criteria->params=array(':id'=>$this->menu_id);
            $criteria->order = '`order`';
            $elements=$this->findAll($criteria); 
            
            $sorted = array();
            
            foreach ($elements as $el) {
                $sorted[$el['parent_id']][] = $el; 
            }
            
            $this->_items = $sorted;
            $this->_result = array();
            $this->_result[] = Yii::t('admin', 'None');
            
            $this->formTree(0, 0);
            return $this->_result;
        }
}