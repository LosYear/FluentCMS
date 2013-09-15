<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property integer $node_id
 * @property integer $author_id
 * @property integer $parent_id
 * @property string $comment
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('node_id, author_id, parent_id, comment', 'required'),
			array('node_id, author_id, parent_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, node_id, author_id, parent_id, comment', 'safe', 'on'=>'search'),
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
			'node_id' => 'Node',
			'author_id' => 'Author',
			'parent_id' => 'Parent',
			'comment' => 'Comment',
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
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}