<?php

/**
 * This is the model class for table "certificate".
 *
 * The followings are the available columns in table 'certificate':
 * @property integer $id
 * @property integer $user_id
 * @property integer $file_name
 */
class Certificate extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Certificate the static model class
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
        return 'certificate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, file_name, title', 'required'),
            array('file_name', 'file', 'types'=>'pdf, doc, docx, png'),
            array('user_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, file_name, title', 'safe', 'on'=>'search'),
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
            'user_id' => Yii::t('RushModule.moderator', 'User'),
            'file_name' => Yii::t('RushModule.moderator', 'Certificate'),
            'title' => Yii::t('admin', 'Title'),
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
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('title',$this->title);
        $criteria->compare('file_name',$this->file_name);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} ?>