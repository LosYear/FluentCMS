<?php

if(empty($tabularIdx))
{
	$this->title=Yum::t('Update user')." ".$model->id;

	$this->breadcrumbs = array(
			Yum::t('Users')=>array('index'),
			$model->username=>array('view','id'=>$model->id),
			Yum::t('Update'));
}

$this->menu=array(
            array('label'=>Yii::t('yum','Create user'), 'url'=>array('create'), 'icon'=>'file black'),
            array('label'=>Yii::t('yum', 'Manage users'), 'url'=>array('admin'), 'icon'=>'list black',),
);

echo $this->renderPartial('/user/_form', array(
			'model'=>$model,
			'passwordform'=>$passwordform,
			'changepassword' => isset($changepassword) ? $changepassword : false,
			'profile'=>$profile,
			'tabularIdx'=> isset($tabularIdx) ? $tabularIdx : 0)
		);
?>
