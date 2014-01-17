<?php

class ProfileController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'edit', 'uploadAvatar'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin' /*,'delete'*/),
                'expression' => '$user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionUploadAvatar($id = null)
    {
        if (is_null($id)) {
            $id = Yii::app()->user->id;
        }

        if (Yii::app()->user->isAdmin()) {
            // Setting admin layout
            $this->layout = 'application.modules.admin.views.layouts.admin';
        } else {
            $this->layout = 'application.modules.author.views.layouts.cabinet';
        }
        $model = YumUser::model()->findByPk($id);

        if (isset($_POST['YumUser'])) {
            $model->attributes = $_POST['YumUser'];
            $model->setScenario('avatarUpload');

            if (Yum::module('avatar')->avatarMaxWidth != 0)
                $model->setScenario('avatarSizeCheck');

            $model->avatar = CUploadedFile::getInstance();
            if ($model->validate()) {
                if ($model->avatar instanceof CUploadedFile) {

                    // Prepend the id of the user to avoid filename conflicts
                    $filename = Yum::module('avatar')->avatarPath . '/' . $model->id . '_' . $_FILES['YumUser']['name']['avatar'];
                    $model->avatar->saveAs($filename);
                    $model->avatar = $filename;
                    if ($model->save()) {
                        Yum::setFlash(Yum::t('The image was uploaded successfully'));
                        Yum::log(Yum::t('User {username} uploaded avatar image {filename}', array(
                            '{username}' => $model->username,
                            '{filename}' => $model->avatar)));
                        $this->redirect('editAvatar');
                    }
                }
            }
        }

        $this->render('edit_avatar', array('model' => $model));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = '`id` = :id';
        $criteria->params = array(':id' => $id);
        $model = Profile::model()->find($criteria);

        // Recent articles
        $criteria = new CDbCriteria();
        $criteria->condition = '`author_id` = :id';
        $criteria->params = array(':id' => $id);

        $publications = ArticleAuthors::model()->findAll($criteria);

        $main_publications = array();
        if ($model->user_id != -1) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'author = :id';
            $criteria->with = array('advanced' => array('select' => false, 'condition' => 'advanced.is_author = 1'));
            $criteria->params = array(':id' => $model->user_id);

            $main_publications = Article::model()->findAll($criteria);
        }

        $this->render('view', array(
            'model' => $model,
            'main_publications' => $main_publications,
            'publications' => $publications
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionEdit()
    {
        if (Yii::app()->user->isAdmin()) {
            // Setting admin layout
            $this->layout = 'application.modules.admin.views.layouts.admin';
        } else {
            $this->layout = '/layouts/cabinet';
        }

        $id = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->condition = '`user_id` = :id';
        $criteria->params = array(':id' => $id);
        $model = Profile::model()->find($criteria);

        $new = false;

        if ($model === null && !isset($_POST['profile_id'])) {
            $model = new Profile;
            $model->email = YumUser::model()->findByPk($id)->profile->email;
            $new = true;
        } else if ($model === null && isset($_POST['profile_id'])) {
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $_POST['profile_id']);
            $model = Profile::model()->find($criteria);
        }

        foreach ($model->attributes as $key => $value) {
            if ($value == '-1') {
                $model->$key = "";
            }
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];

            foreach ($model->attributes as $key => $value) {
                if ($value == '-1') {
                    $model->$key = "";
                }
            }

            $model->user_id = Yii::app()->user->id;

            $model->image = CUploadedFile::getInstance($model, 'image');
            $filename = null;

            if ($model->image instanceof CUploadedFile) {
                $filename = Yii::getPathOfAlias('webroot.resources.uploads.avatars') . '/' . $model->id . '.' . $model->image->extensionName;
                $model->avatar = $model->id . '.' . $model->image->extensionName;
            }

            if ($model->save()) {
                $user = YumUser::model()->findByPk($id)->profile;
                $user->email = $model->email;
                $user->save();

                if ($model->image instanceof CUploadedFile) {
                    $model->image->saveAs($filename);
                }

                $this->redirect(array('article/admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'new' => $new,
        ));
    }

    public function actionUpdate($id)
    {
        if (Yii::app()->user->isAdmin()) {
            // Setting admin layout
            $this->layout = 'application.modules.admin.views.layouts.admin';
        }

        $model = Profile::model()->findByPk($id);

        $new = false;

        foreach ($model->attributes as $key => $value) {
            if ($value == '-1') {
                $model->$key = "";
            }
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];

            foreach ($model->attributes as $key => $value) {
                if ($value == '') {
                    $model->$key = -1;
                }
            }

            //$model->user_id = Yii::app()->user->id;
            $model->image = CUploadedFile::getInstance($model, 'image');
            $filename = null;

            if ($model->image instanceof CUploadedFile) {
                $filename = Yii::getPathOfAlias('webroot.resources.uploads.avatars') . '/' . $model->id . '.' . $model->image->extensionName;
                $model->avatar = $model->id . '.' . $model->image->extensionName;
            }


            if ($model->save()) {
                $user = YumUser::model()->findByPk($id);
                if(!is_null($user)){
                    $user = $user->profile;
                    $user->email = $model->email;
                    $user->save();
                }

                if ($model->image instanceof CUploadedFile) {
                    $model->image->saveAs($filename);
                }
                Yii::app()->user->setFlash('success', Yii::t('AuthorModule.admin', 'Information about "%s" has been updated', array('%s' => $model->name)));

                $this->redirect(array('profile/admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'new' => $new,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if ($model->user_id != -1) {
            YumUser::model()->findByPk($model->user_id)->delete();
        }
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    /*public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Profile');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }*/

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        if (Yii::app()->user->isAdmin()) {
            // Setting admin layout
            $this->layout = 'application.modules.admin.views.layouts.admin';

        }
        $model = new Profile('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Profile']))
            $model->attributes = $_GET['Profile'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = '`user_id` = :id';
        $criteria->params = array(':id' => $id);
        $model = Profile::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
