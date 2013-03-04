<?php

class MenuDisplayController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    /**
     * Returns main menu items
     * @return array
    */
    
    public static function getMenuItems(){
        $result = array();
        // Home button
        $result[] = array(
            'label' => Yii::t('admin', 'Home'),
            'url' => 'backend.php',
            'icon' => 'th-large white',
        );
        
        // Content drop-down        
        $result[] = array(
            'label' => Yii::t('admin', 'Content'),
            'icon' => 'book white',
            'items' => MenuDisplayController::getContentItems(),
        );
        
        // Structure drop-down
        $result[] = array(
            'label' => Yii::t('admin', 'Structure'),
            'icon' => 'folder-open white',
            'items' => MenuDisplayController::getStructureItems(),);
        
        // Users drop-down
        $result[] = array(
            'label' => Yii::t('admin', 'Users'),
            'icon' => 'user white',
            'items' => MenuDisplayController::getUsersItems(),);
        
        // !- PLUGIN -! //
            
        $result[] = array(
          'label' => Yii::t('author', 'Journal'),
          'icon' => 'briefcase white',
          'items' => MenuDisplayController::getJournalItems(),
            
        );
        
        $result[] = array(
          'label' => Yii::t('rush', 'Olympiad'),
          'icon' => 'fire white',
          'items' => MenuDisplayController::getRushItems(),
            
        );
        
        return $result;
    }
    
    /**
     *  Returns subitems for 'Content' drop-down
     * @return array
     */
    
    public static function getContentItems(){
        $result = array();
        
        $result[] = array(
            'label' => Yii::t('admin', 'Pages'),
            'icon' => 'file black',
            'url' => Yii::app()->createUrl('pages'),
        );
        
        $result[] = array(
            'label' => Yii::t('admin', 'News'),
            'icon' => 'leaf black',
            'url' => Yii::app()->createUrl('news'),
        );
        
        $result[] = array(
            'label' => Yii::t('admin', 'Blocks'),
            'icon' => 'th-large black',
            'url' => Yii::app()->createUrl('blocks'),
        );
        
        return $result;
    }
    
    /**
     * Returns items for right menu
     * @return array
     */

    public static function getRightItems(){
        $result = array();
        
        /*$result[] = array(
            'label' => Yii::t('admin', 'Site'),
            'icon' => 'home white',
            'url' => Yii::app()->homeUrl,
        );
        
        $result[] = '---';*/
        
        $result[] = array(
            'label' => Yii::t('admin', 'Logout'),  
            'icon' => 'off white',
            'url' => '#',
        );
        
        return $result;
    }
    
    /**
     * Returns items for structure drop-down
     * @return array
     */
    public static function getStructureItems(){
        $result[] = array(
            'label' => Yii::t('admin', 'Menu'),
            'icon' => 'list black',
            'url' => Yii::app()->createUrl('menu'),
        );
        
        return $result;
    }
    
    public static function getJournalItems(){
        $result[] = array(
            'label' => Yii::t('author', 'Issues'),
            'icon' => 'edit',
            'url' => Yii::app()->createUrl('issue'),
        );
        $count = 5;
        
        $result[] = array(
            'label' => Yii::t('author', 'Articles')/*."<span class=\"badge badge-info\">$count</span>"*/,
            'icon' => 'inbox black',
            'url' => Yii::app()->createUrl('article'),
        );
        
        return $result;
    }
    /**
     * Returns items for users drop-down
     * @return array
     */
    public static function getUsersItems(){
        $result = array();
        
        $result[] = array(
            'label' => Yii::t('admin', 'Statistics'),  
            'icon' => 'tasks',
            'url' => Yii::app()->createUrl('user/statistics'),
        );
        
        $result[] = array(
            'label' => Yii::t('admin', 'Users'),  
            'icon' => 'user',
            'url' => Yii::app()->createUrl('user/user/admin'),
        );
                
         $result[] = array(
            'label' => Yii::t('admin', 'Roles'),  
            'icon' => 'globe',
            'url' => Yii::app()->createUrl('role/role/admin'),
        );
                        
        $result[] = array(
            'label' => Yii::t('admin', 'Permissions'),  
            'icon' => 'asterisk',
            'url' => Yii::app()->createUrl('role/permission/admin'),
        );
                                
        $result[] = array(
            'label' => Yii::t('admin', 'Actions'),  
            'icon' => 'plus-sign',
            'url' => Yii::app()->createUrl('role/action/admin'),
        );
        
        return $result;
    }
    
    /**
     * Return array for rush module's menu
     */
    
    public static function getRushItems(){
        $result = array();
        
        $result[] = array(
            'label' => Yii::t('admin', 'Categories'),  
            'icon' => 'list-alt',
            'url' => Yii::app()->createUrl('rush/category'),
        );
        
        $result[] = array(
            'label' => Yii::t('admin', 'Tours'),  
            'icon' => 'road',
            'url' => Yii::app()->createUrl('rush/tour'),
        );
        
        $result[] = array(
            'label' => Yii::t('admin', 'Tasks'),  
            'icon' => 'screenshot',
            'url' => Yii::app()->createUrl('rush/task'),
        );
        
        return $result;
    }
}