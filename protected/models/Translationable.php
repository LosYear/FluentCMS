<?php

/**
 * This is the model class for table "node".
 *
 * The followings are the available columns in table 'node':
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $content
 * @property integer $author
 * @property string $created
 * @property string $updated
 * @property integer $updater
 * @property string $url
 * @property string $status
 * @property integer $root_id
 * @property integer $lang_id
 */
class Translationable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Translationable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns true if item is translated to selected language
	 */

	public function isTranslated($id){
		$default_lang = Language::defaultID();

		if($id == $default_lang){
			return true;
		}

		$criteria = new CDbCriteria();
		$criteria->condition = '`root_id` = :root_id AND `lang_id` = :lang';

		$root_id = $this->id;
		if($this->root_id != '-1'){
			$root_id = $this->root_id;
		}
		$criteria->params = array('root_id' => $root_id, 'lang' => $id);

		if($this->count($criteria) > 0){
			return true;
		}
		return false;
	}

	/**
	 * Returns all languages which have no translation for current model
	 * @return array
	 */

	public function untranslatedLanguagesList(){
		$languages = Language::model()->findAll();
		$result = array();

		foreach($languages as $lang){
			if(!$this->isTranslated($lang->id)){
				$result[] = $lang;
			}
		}

		return $result;
	}

	/**
	 * Returns list of languages which have translations
	 */
	public function translatedLanguageList(){
		$languages = Language::model()->findAll();
		$result = array();

		foreach($languages as $lang){
			if($this->isTranslated($lang->id)){
				$result[] = $lang;
			}
		}

		return $result;
	}

	/**
	 * Finds a translation if any
	 */
	public function getTranslation($lang){
		$default_lang = Language::defaultID();

		if($this->root_id == -1 && $lang == $default_lang){
			return $this;
		}
		if($lang == $default_lang){
			return $this->findByPk($this->root_id);
		}

		$criteria = new CDbCriteria();
		$criteria->condition = '`root_id` = :root_id AND `lang_id` = :lang';

		$root_id = $this->id;
		if($this->root_id != '-1'){
			$root_id = $this->root_id;
		}
		$criteria->params = array('root_id' => $root_id, 'lang' => $lang);

		$result = $this->find($criteria);
		if($result === null){
			return $this;
		}
		return $result;
	}

}