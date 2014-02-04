<?php

class ArticleController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $defaultAction = 'admin';

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
                'actions' => array('index', 'view', 'search', 'tagged', 'favorite', 'downloadPDF', 'print', 'rss'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin'),
                'expression' => '!$user->isGuest',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete'),
                'expression' => '$user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction(){
        $action = $this->action->id;
        $action_bool = ($action == 'create' || $action == 'update' || $action == 'admin');
        if($action_bool && Yii::app()->user->status == 0){
            $this->redirect('profile/activate');
        }

        return true;
    }


    private function loadData($id)
    {
        // Getting information from cache
        $article = Yii::app()->cache->get("article_" . $id);

        if ($article === false) {
            // If there is no data in cache put it there

            $model = $this->loadModel($id);
            $modelTranslated = $model->getTranslation(Language::getCurrentID());

            // Getting information about authors
            $authors = $modelTranslated->getAuthors();

            // Getting tags
            $tags_array = $modelTranslated->getTags();

            // Loading aditional information
            $advModel = $modelTranslated->advanced;

            // Incrementing views
            $modelTranslated->incrementViews();


            $liked = $model->isLiked();

            $article['model'] = $modelTranslated;
            $article['advModel'] = $modelTranslated->advanced;
            $article['authors'] = $authors;
            $article['tags_rus'] = $tags_array;

            Yii::app()->cache->set("article_" . $id, $article, Yii::app()->params['cacheDuration']);
        }

        $liked = $model->isLiked();

        $article['liked'] = $liked;

        return $article;
    }


    public function actionPrint($id)
    {
        $article = $this->loadData($id);

        $this->layout = '//layouts/print';

        $this->render('print', array(
            'model' => $article['model'],
            'advModel' => $article['advModel'],
            'authors' => $article['authors'],
            'tags_rus' => $article['tags_rus'],
            'liked' => $article['liked'],
            'issue_info' => Issue::model()->findByPk($article['advModel']->issue_id),
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $article = $this->loadData($id);

        $this->render('view', array(
            'model' => $article['model'],
            'advModel' => $article['advModel'],
            'authors' => $article['authors'],
            'tags_rus' => $article['tags_rus'],
            'liked' => $article['liked'],
            'issue_info' => Issue::model()->findByPk($article['advModel']->issue_id),
        ));
    }

    /**
     * Creates relation between tag and article
     * @param mixed $tag
     * @param int $id
     * @param string $lang
     */

    private function addTag($tag, $id, $lang)
    {
        if (!is_int($tag)) {
            // Add tag into database then create relation

            $model = new Tag();
            $model->tag = $tag;
            $model->lang = $lang;

            $model->save();
            $tag = $model->id;
        }

        // Creating relation between article and tag
        $model = new ArticleTags();
        $model->node_id = $id;
        $model->tag_id = $tag;
        $model->save();
    }

    /**
     * Creates relation between author and article
     * @param mixed $id id or name of author
     * @param id $article_id id of article
     */
    private function addAuthor($id, $article_id)
    {
        if (is_int($id)) {
            // Author exists
            $relation = new ArticleAuthors;
            $relation->node_id = $article_id;
            $relation->author_id = $id;
            $relation->save() or die($relation->author_id);
        } else {
            // Author doesn't exist

            // Create new profile without user
            $profile = new Profile;
            $profile->user_id = -1;
            $profile->email = '-1';
            $profile->academic = '-1';
            $profile->name = $id;
            $profile->job = '-1';
            $profile->branch = '-1';

            $profile->save() or die ("PROFILE 1");

            // Now, author exists. We can create relations
            $relation = new ArticleAuthors;
            $relation->node_id = $article_id;
            $relation->author_id = $profile->id;
            $relation->save() or die($profile->name);
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($root_id = -1, $lang = null)
    {
        if (Yii::app()->user->isAdmin()) {
            // Setting admin layout
            $this->layout = 'application.modules.admin.views.layouts.admin';
        } else if (Yii::app()->user->isGuest) {
            Yii::app()->user->setReturnUrl(Yii::app()->createUrl('author/article/create'));
            Yii::app()->user->setFlash('warning', Yii::t('AuthorModule.main', 'To create article you need to be registered user. Please login or register'));
            $this->redirect('/user/auth');
        } else {
            $this->layout = '/layouts/cabinet';
        }

        $model = new Article;
        $advModel = new ArticleAdv;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->author = Yii::app()->user->id;
            $model->created = new CDbExpression('NOW()');

            $advModel->attributes = $_POST['ArticleAdv'];
            $advModel->node_id = 0;
            $advModel->views = 0;
            $advModel->likes = 0;

            $model->root_id = $root_id;
            $model->lang_id = $lang;

            if ($lang == null) {
                $model->lang_id = Language::defaultID();
            }

            if (!Yii::app()->user->isAdmin()) {
                $model->status = 2;
                $model->url = '_';
                $advModel->issue_id = -1;
                $advModel->is_author = 1;
            }


            if ($model->validate() && $advModel->validate()) {
                $advModel->pdf = CUploadedFile::getInstance($advModel, 'pdf');
                $advModel->image = CUploadedFile::getInstance($advModel, 'image');

                $model->save();
                $advModel->node_id = $model->id;

                $imagePath = null;

                $advModel->save();
                if ($advModel->pdf != null) {
                    $advModel->pdf->saveAs(Yii::getPathOfAlias('webroot.resources.uploads.pdf') . '/' . $model->url . '.pdf');
                }
                if ($advModel->image != null) {
                    $imagePath = Yii::getPathOfAlias('webroot.resources.uploads.article_images') . '/' . $model->id . '.' . $advModel->image->extensionName;
                    $advModel->image->saveAs($imagePath);
                }

                // Inserting authors
                $authors = json_decode($advModel->aditional_authors, true);

                foreach ($authors as $key => $value) {
                    if ($value == 1) {
                        // Author will be added to database
                        $this->addAuthor($key, $model->id);
                    }
                }

                // Inserting tags
                $tags = json_decode($advModel->tags, true);

                foreach ($tags as $key => $value) {
                    if ($value == 1) {
                        $this->addTag($key, $model->id, $model->lang_id);
                    }
                }

                // Posting to social networks
                if (Yii::app()->user->isAdmin() && $model->status == 1) {
                    $link = Yii::app()->homeUrl . '/' . $model->url . '.html';
                    if ($_POST['ArticleAdv']['exportTwitter'] == '1') {
                        // Publishing to twitter
                        $str = substr($model->title, 0, 110) . "... " . $link;
                        $twAPI = new TwitterApi();
                        $twAPI->buildOauth("https://api.twitter.com/1.1/statuses/update.json", 'POST')
                            ->setPostfields(array('status' => $str))
                            ->performRequest();
                    }
                    if ($_POST['ArticleAdv']['exportVK'] == '1') {
                        // Publishing to vk
                        if ($advModel->image != null) {
                            VkApi::post(strip_tags($advModel->annotation), $link, $imagePath);
                        } else {
                            VkApi::post(strip_tags($advModel->annotation), $link);
                        }
                    }
                    if ($_POST['ArticleAdv']['exportFacebook'] == '1') {
                        // Publishing to facebook
                        if ($advModel->image != null) {
                            $imageUrl = Yii::app()->homeUrl . '/resources/uploads/article_images/' . $model->id . '.' . $advModel->image->extensionName;
                            FacebookApi::postLink($link, $model->title, strip_tags($advModel->annotation), $imageUrl);
                        } else {
                            FacebookApi::postLink($link, $model->title, strip_tags($advModel->annotation));
                        }
                    }
                }

                Yii::app()->cache->delete("issue_" . $advModel->issue_id);

                Yii::app()->user->setFlash('success', Yii::t('AuthorModule.admin', 'Article "%s" has been created', array('%s' => $model->title)));

                $this->redirect(array('article/admin'));
            }
        }

        $source = null;
        $t = false;
        if ($root_id != -1) {
            $source = Article::model()->findByPk($root_id);
            $advSource = ArticleAdv::model()->findByPk($root_id);
            $model->url = $source->url;
            $advModel->issue_id = $advSource->issue_id;
            $model->status = $source->status;
            $advModel->is_author = $advSource->is_author;

            $t = true;
        }
        $lang_info = null;
        if ($lang != null) {
            $lang_info = Language::model()->findByPk($lang);
        } else {
            $lang_info = Language::model()->findByPk(Language::defaultID());
        }

        $this->render('create', array(
            'model' => $model,
            'advModel' => $advModel,
            'source' => $source,
            'lang' => $lang_info,
            'translation' => $t,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        if (Yii::app()->user->isAdmin()) {
            // Setting admin layout
            $this->layout = 'application.modules.admin.views.layouts.admin';
        } else {
            $this->layout = '/layouts/cabinet';
        }

        $model = $this->loadModel($id);
        $advModel = ArticleAdv::model()->find('node_id = :id', array(':id' => $id));

        // Getting info about aditional authors
        $criteria = new CDbCriteria();
        $criteria->condition = '`node_id` = :id';
        $criteria->params = array(':id' => $id);

        $relation = ArticleAuthors::model();
        $authors = $relation->findAll($criteria);

        $relations = array();

        foreach ($authors as $element) {
            $author_id = $element->author_id;

            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $author_id);

            $profile = Profile::model()->find($criteria);

            $relations[$profile->id] = $profile->name;
        }

        $advModel->aditional_authors = json_encode($relations);

        // Getting information about tags
        $criteria = new CDbCriteria();
        $criteria->condition = '`node_id` = :id';
        $criteria->params = array(':id' => $id);

        $tags = ArticleTags::model()->findAll($criteria);

        $tags_array = array();

        foreach ($tags as $tag) {
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $tag->tag_id);

            $info = Tag::model()->find($criteria);

            if ($info->lang == $model->lang_id) {
                $tags_array[$tag->tag_id] = $info->tag;
            }
        }

        $advModel->tags = json_encode($tags_array);

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->updated = new CDbExpression('NOW()');
            $model->updater = Yii::app()->user->id;

            $tmp_file = $advModel->pdf;
            $tmp_file2 = $advModel->image;

            $advModel->attributes = $_POST['ArticleAdv'];
            $advModel->node_id = 0;

            $advModel->pdf = CUploadedFile::getInstance($advModel, 'pdf');

            $up = true;
            if ($advModel->pdf == null) {
                $advModel->pdf = $tmp_file;
                $up = false;

            }

            $advModel->image = CUploadedFile::getInstance($advModel, 'image');

            $up1 = true;
            if ($advModel->image == null) {
                $advModel->image = $tmp_file2;
                $up1 = false;

            }

            if ($model->validate() && $advModel->validate()) {

                $model->save();
                $advModel->node_id = $model->id;
                $advModel->save();

                if ($up) {
                    $advModel->pdf->saveAs(Yii::getPathOfAlias('webroot.resources.uploads.pdf') . '/' . $model->url . '.pdf');
                }

                $imagePath = null;

                if ($up1) {
                    $imagePath = Yii::getPathOfAlias('webroot.resources.uploads.article_images') . '/' . $model->id . '.' . $advModel->image->extensionName;
                    $advModel->image->saveAs($imagePath);
                }

                // Save information about aditional authors
                $authors = json_decode($advModel->aditional_authors, true);

                foreach ($authors as $id => $value) {
                    if ($value == 0) {
                        // Author has been deleted.
                        if (is_int($id)) {
                            // Author exists in database and may be there is a relation

                            $criteria = new CDbCriteria();
                            $criteria->condition = '`author_id` = :id AND `node_id` = :node';
                            $criteria->params = array(':id' => $id, ':node' => $model->id);

                            $relation = ArticleAuthors::model();

                            if ($relation->count($criteria) > 0) {
                                // There is a relation. Delete it
                                $relation->find($criteria)->delete();
                            }
                        }
                        // Else, author doesn't exists. That means,
                        // that there is no relations
                    } elseif ($value == 1) {
                        // Author has been added
                        $this->addAuthor($id, $model->id);
                    }
                }

                // Save information about russian tags
                $tags = json_decode($advModel->tags, true);

                foreach ($tags as $id => $value) {
                    if ($value == 0) {
                        if (is_int($id)) {
                            // Tag exists
                            // Maybe there is a relation between tag and article

                            $criteria = new CDbCriteria();
                            $criteria->condition = '`node_id` = :id AND `tag_id` = :tag';
                            $criteria->params = array(':id' => $model->id, ':tag' => $id);

                            if (ArticleTags::model()->count($criteria) > 0) {
                                // There is a relation and we must remove it
                                ArticleTags::model()->find($criteria)->delete();
                            }
                        }

                    } elseif ($value == 1) {
                        $this->addTag($id, $model->id, $model->lang_id);
                    }

                }

                // Posting to social networks
                if (Yii::app()->user->isAdmin() && $model->status == 1) {
                    $link = Yii::app()->homeUrl . '/' . $model->url . '.html';
                    $extension = null;

                    if($up1){
                        $extension = $advModel->image->extensionName;
                    }
                    elseif ($advModel->image != null){
                        $extension = pathinfo($advModel->image, PATHINFO_EXTENSION);
                    }

                    if($imagePath == null && $advModel->image != null){
                        $imagePath = Yii::getPathOfAlias('webroot.resources.uploads.article_images') . '/' . $model->id . '.' . $extension;
                    }

                    if (isset($_POST['ArticleAdv']['exportTwitter']) && $_POST['ArticleAdv']['exportTwitter'] == '1') {
                        // Publishing to twitter
                        $str = substr($model->title, 0, 110) . "... " . $link;
                        $twAPI = new TwitterApi();
                        $twAPI->buildOauth("https://api.twitter.com/1.1/statuses/update.json", 'POST')
                            ->setPostfields(array('status' => $str))
                            ->performRequest();
                    }
                    if (isset($_POST['ArticleAdv']['exportVK']) && $_POST['ArticleAdv']['exportVK'] == '1') {
                        // Publishing to vk
                        if ($advModel->image != null) {
                            VkApi::post(strip_tags($advModel->annotation), $link, $imagePath);
                        } else {
                            VkApi::post(strip_tags($advModel->annotation), $link);
                        }
                    }
                    if (isset($_POST['ArticleAdv']['exportFacebook']) && $_POST['ArticleAdv']['exportFacebook'] == '1') {
                        // Publishing to facebook
                        if ($advModel->image != null) {
                            $imageUrl = Yii::app()->homeUrl . '/resources/uploads/article_images/' . $model->id . '.' . $extension;
                            FacebookApi::postLink($link, $model->title, strip_tags($advModel->annotation), $imageUrl);
                        } else {
                            FacebookApi::postLink($link, $model->title, strip_tags($advModel->annotation));
                        }
                    }
                }

                Yii::app()->cache->delete("issue_" . $advModel->issue_id);
                Yii::app()->cache->delete("article_" . $model->id);

                Yii::app()->user->setFlash('success', Yii::t('AuthorModule.admin', 'Article "%s" has been updated', array('%s' => $model->title)));
                $this->redirect(array('article/admin'));
            }
        }
        $source = $model->getTranslation(Language::defaultID());
        $t = $model->id != $source->id;

        $this->render('update', array(
            'model' => $model,
            'advModel' => $advModel,
            'source' => $source,
            'lang' => Language::model()->findByPk($model->lang_id),
            'translation' => $t
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        // Deleting node
        $this->loadModel($id)->delete();

        // Removing additional information
        $criteria = new CDbCriteria();
        $criteria->condition = '`node_id` = :id';
        $criteria->params = array(':id' => $id);

        $adv = ArticleAdv::model()->find($criteria);
        $issue_id = $adv->issue_id;

        // Removing cache
        Yii::app()->cache->delete("issue_" . $issue_id);
        Yii::app()->cache->delete("article_" . $id);


        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Article');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        if (Yii::app()->user->isAdmin()) {
            // Setting admin layout
            $this->layout = 'application.modules.admin.views.layouts.admin';

        } else {
            $this->layout = '/layouts/cabinet';
        }

        $model = new Article('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Article']))
            $model->attributes = $_GET['Article'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Search action. Searches article by title or content
     */
    public function actionSearch()
    {
        $result = array();
        $authors = array();
        if (isset($_REQUEST['query'])) {
            $criteria = new CDbCriteria();

            $criteria->condition = "`type` = 'author/article' AND (`title` LIKE :query OR `content` LIKE :query2 OR `annotation` LIKE :query3)";
            $criteria->params = array(
                ':query' => '%' . addcslashes($_REQUEST['query'], '%_') . '%',
                ':query2' => '%' . addcslashes($_REQUEST['query'], '%_') . '%',
                ':query3' => '%' . addcslashes($_REQUEST['query'], '%_') . '%',
            );
            $criteria->order = '`created` DESC';

            $model = Article::model();
            $model->type = '';
            $articles = $model->with('advanced')->findAll($criteria);

            // Loading translations, if any
            $result = array();
            foreach ($articles as $el) {
                $result[] = $el->getTranslation(Language::getCurrentID());
            }

            // Searching for authors
            $criteria = new CDbCriteria();

            $criteria->condition = "`name` LIKE :query";
            $criteria->params = array(
                ':query' => '%' . addcslashes($_REQUEST['query'], '%_') . '%',
            );

            $authors = Profile::model()->findAll($criteria);
        }

        $dataProvider = new CArrayDataProvider($result);

        $this->render('search', array('dataProvider' => $dataProvider, 'query' => $_REQUEST['query'], 'authors' => $authors));
    }

    /**
     * Searches all articles by tag id
     */
    public function actionTagged($tag)
    {
        $result = array();

        $criteria = new CDbCriteria();
        $criteria->condition = '`tag_id` = :id';
        $criteria->params = array(':id' => $tag);

        $all = ArticleTags::model()->findAll($criteria);

        foreach ($all as $el) {
            $result[] = $el->article->getTranslation(Language::getCurrentID());
			
        }
		
		$dataProvider = new CArrayDataProvider($result);

        $this->render('search', array('dataProvider' => $dataProvider, 'query' => Tag::model()->findByPk($tag)->tag));

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Article::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'article-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Shows liked articles
     */
    public function actionFavorite()
    {
        $result = array();
        if (!Yii::app()->user->isGuest) {
            // User isn't guest. Requesting data from DB
            $criteria = new CDbCriteria();
            $criteria->condition = '`user_id` = :id';
            $criteria->params = array(':id' => Yii::app()->user->id);

            $model = ArticleVote::model();
            $ids = $model->findAll($criteria);

            foreach ($ids as $el) {
                $result[] = $el->article->article->getTranslation(Language::getCurrentID());
            }
        } else {
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            if (isset(Yii::app()->session['favorite'])) {
                foreach (Yii::app()->session['favorite'] as $key => $value) {
                    $criteria->params = array(':id' => $key);
                    $result[] = Article::model()->find($criteria)->getTranslation(Language::getCurrentID());
                }
            }
        }

        $dataProvider = new CArrayDataProvider($result);

        $this->render('favorite', array('dataProvider' => $dataProvider));
    }

    public function actionDownloadPDF($id)
    {
        $model = ArticleAdv::model()->findByPk($id);

        if ($model->pdf != null) {
            $m = Article::model()->findByPk($id);

            Yii::app()->getRequest()->sendFile($m->title . '.pdf', file_get_contents(Yii::getPathOfAlias('webroot.resources.uploads.pdf') . '/' . $m->url . '.pdf'));
        }
    }

    public function actionRSS()
    {
        $this->layout = '//layouts/rss';
        $criteria = new CDbCriteria();
        $criteria->limit = 30;
        $criteria->with = array('article' => array('select' => false, 'condition' => 'article.status = 1', 'order' => 'created DESC'));

        $result = ArticleAdv::model()->findAll($criteria);

        //$this->render('rss', array('items' => $result));
        $this->renderPartial('rss', array('items' => $result));
    }
}
