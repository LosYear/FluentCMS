<?php

class SubscriptionController extends Controller
{
    public function actionSend()
    {
        $this->layout = 'application.modules.admin.views.layouts.admin';

        $model = new Subscription;
        if (isset($_POST['Subscription'])) {
            $model->attributes = $_POST['Subscription'];

            if ($model->validate()) {
                $mailer = new YiiMailer();
                $mailer->IsSMTP();
                $mailer->SMTPAuth = true;
                $mailer->SMTPSecure = '';
                $mailer->Subject = $model->subject;

                $mailer->Host = $model->smtp;

                $mailer->Port = $model->port;

                $mailer->Username = $model->login;

                $mailer->Password = $model->password;
                $mailer->From = $model->sender;
                $mailer->FromName = Yii::app()->name;

                $mailer->Body = $model->text;

                $criteria = new CDbCriteria();
                $criteria->condition = '`subscription` = 1';
                $users = Profile::model()->findAll($criteria);

                foreach ($users as $user) {
                    $mailer->ClearAddresses();
                    $mailer->AddAddress($user->email);
                    $mailer->send();
                }

                $model = new Subscription();
                Yii::app()->user->setFlash('success', Yii::t('AuthorModule.admin', 'All mails are sent'));
            }
        }

        $this->render('send', array('model' => $model));
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}