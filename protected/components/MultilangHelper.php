<?php class MultilangHelper
{
	public static function enabled()
	{
		return true;
		return count(Yii::app()->params['translatedLanguages']) > 1;
	}

	public static function suffixList()
	{
		$list = array();
		$enabled = self::enabled();

		$langs = Language::model()->findAll();

		foreach ($langs as $el) {
			if ($el->name === Yii::app()->params['defaultTranslationLanguage']) {
				$suffix = '';
				$list[$suffix] = $enabled ? $el->name  : '';
			} else {
				$suffix = '_' . $el->name ;
				$list[$suffix] = $el->name;
			}
		}

		return $list;
	}

	public static function languagesList(){
		$langs = Language::model()->findAll();

		$result = array();

		foreach($langs as $el){
			$result[$el->name] = $el->name;
		}

		return $result;
	}

	public static function processLangInUrl($url)
	{
		if (self::enabled()) {
			$domains = explode('/', ltrim($url, '/'));

			$isLangExists = in_array($domains[0], array_keys(MultilangHelper::languagesList()));
			$isDefaultLang = $domains[0] == Yii::app()->params['defaultTranslationLanguage'];

			if ($isLangExists && !$isDefaultLang) {
				$lang = array_shift($domains);
				Yii::app()->setLanguage($lang);
			}

			$url = '/' . implode('/', $domains);
		}

		return $url;
	}

	public static function addLangToUrl($url)
	{
		if (self::enabled()) {
			$domains = explode('/', ltrim($url, '/'));
			$isHasLang = in_array($domains[0], array_keys(MultilangHelper::languagesList()));
			$isDefaultLang = Yii::app()->getLanguage() == Yii::app()->params['defaultTranslationLanguage'];

			if ($isHasLang && $isDefaultLang)
				array_shift($domains);

			if (!$isHasLang && !$isDefaultLang)
				array_unshift($domains, Yii::app()->getLanguage());

			$url = '/' . implode('/', $domains);
		}

		return $url;
	}
}