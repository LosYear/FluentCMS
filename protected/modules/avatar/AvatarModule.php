<?php
Yii::setPathOfAlias('AvatarModule' , dirname(__FILE__));

class AvatarModule extends CWebModule {
	public $defaultController = 'avatar';

	// override this with your custom layout, if available
	public $layout = 'application.modules.profile.views.layouts.user';

	public $avatarPath = 'data/avatar';

	// Set avatarMaxWidth to a value other than 0 to enable image size check
	public $avatarMaxWidth = 0;

	public $avatarThumbnailWidth = 84; // For display in user browse, friend list
	public $avatarDisplayWidth = 200;

	public $enableGravatar = false;

	public $controllerMap=array(
		'avatar'=>array('class'=>'AvatarModule.controllers.YumAvatarController'),
	);

	public function init() {
                if(defined('BACKEND'))
                    $this->layout = 'application.modules.profile.views.layouts.admin';
                Yum::module('rush');
            //   $this->avatarPath = Yii::getPathOfAlias('application.modules.avatar.data');
		$this->setImport(array(
					'application.modules.user.controllers.*',
					'application.modules.user.models.*',
					'application.modules.avatar.controllers.*',
					'application.modules.avatar.models.*',
					));
	}



}
