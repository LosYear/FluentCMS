<?php

/**
 * This is the model class for table "banner".
 *
 * The followings are the available columns in table 'banner':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $type
 * @property string $href
 * @property integer $new_window
 * @property integer $views
 * @property integer $clicks
 */
class Banner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, title, type, href, new_window, views, clicks, status', 'required'),
			array('id, new_window, views, clicks, status', 'numerical', 'integerOnly'=>true),
            array('file', 'file', 'on' => 'insert', 'allowEmpty'=>false, 'types' => 'jpeg, jpg, gif, png, bmp, swf'),
            array('file', 'file','on'=>'update', 'allowEmpty' => true, 'types'=> 'jpeg, jpg, gif, png, bmp, swf'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, title, type, href, new_window, views, clicks, status', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('BannerModule.model', 'Name'),
			'title' => Yii::t('BannerModule.model', 'Title'),
			'type' => Yii::t('BannerModule.model', 'Type'),
			'href' => Yii::t('BannerModule.model', 'Link'),
			'new_window' => Yii::t('BannerModule.model', 'Open in new window'),
			'views' => Yii::t('BannerModule.model', 'Views'),
			'clicks' => Yii::t('BannerModule.model', 'Clicks'),
            'file' => Yii::t('BannerModule.model', 'File'),
            'status' => Yii::t('BannerModule.model', 'Status')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('href',$this->href,true);
		$criteria->compare('new_window',$this->new_window);
		$criteria->compare('views',$this->views);
		$criteria->compare('clicks',$this->clicks);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function incrementViews(){
        $this->views++;
        $this->save();
    }

    public function incrementClicks(){
        $this->clicks++;
        $this->save();
    }
}
