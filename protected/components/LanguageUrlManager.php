<?php
	class LanguageUrlManager extends CUrlManager
	{
		public function createUrl($route, $params=array(), $ampersand='&')
		{
			$url = parent::createUrl($route, $params, $ampersand);
			return MultilangHelper::addLangToUrl($url);
		}
	}
?>