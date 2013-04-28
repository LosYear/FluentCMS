<?php

class DefaultController extends Controller
{
        public $layout = 'admin';
	public function actionIndex()
	{
		$this->render('index');
	}
}