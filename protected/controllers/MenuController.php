<?php
class MenuController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Getting menu list. Deprecated function. Will be replaced by menu manager.
     * @deprecated
     * @return  array Menu List
     */
    public static function getMenuItems() {
        $result = array(); // Empty array

        $pages = Page::model();
        $all = $pages->findAll(array(
            'order' => 'id',
                ));

        // Adding home button
        $active = false;
        if( !isset($_GET['id'])){
            $active = true;
        }
        $result[] = array(
            'label' => Yii::t('main', 'Home'),
            'url' => Yii::app()->homeUrl,
            'active' => $active,
        );
        
        // Adding pages
        foreach ($all as $element) {
            if($element->status == 1 && $element->type == 'page'){ // Page is public
                $active = false;

                if (isset($_GET['id']) && ($_GET['id'] == $element->id)){
                    //Current page
                    $active = true;
                }

                $result[] = array(
                    'label' => $element->title,
                    'url' => Yii::app()->createUrl($element->url),
                    'active' => $active,
                );
            }
        }
        return $result;
    }
    
    /*
     * Getting items, login/register, admin, etc.
     * @return array
     */
    public static function getUserItems(){
        if (Yii::app()->user->isGuest){
            // Return Login and Register items
            $result[] = array(
              'label' => Yii::t('main', 'Login'),
              'url' => Yii::app()->createUrl('user/user/login'),
            );
            
            $result[] = array(
              'label' => Yii::t('main', 'Registration'),
              'url' => Yii::app()->createUrl('registration/registration'),
            );
            
            return $result;
        }
        else{
            if(Yii::app()->user->isAdmin()){
                $result[] = array(
                  'label' => 'Admin',
                  'url' => 'backend.php',
                );
            }
            
            $result[] = array(
              'label' => Yii::t('main', 'Logout'),
              'url' => Yii::app()->createUrl('user/user/logout'),
            );
            return $result;
        }
    }

}