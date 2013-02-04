<?php
class MenuItemsController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Getting menu list. Deprecated function. Will be replaced by menu manager.
     * @deprecated
     * @return  array Menu List
     */
    public static function getProfileItems() {
        $result = array(); // Empty array
        
        $result[] = array(
            'label' => Yii::t('authorModule.main', 'Dashboard'),
            'url' => 'index',
            'icon' => 'th-large black',
        );
        
        $result[] = array(
            'label' => Yii::t('authorModule.main', 'Edit profile'),
            'url' => Yii::app()->createUrl('author/profile/edit'),
            'icon' => 'user black',
        );
        
        $result[] = array(
            'label' => Yii::t('authorModule.main', 'Articles'),
            'url' => Yii::app()->createUrl('author/article'),
            'icon' => 'file black',
        );
        return $result;
    }

}