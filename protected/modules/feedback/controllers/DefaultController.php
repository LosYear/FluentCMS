<?php

class DefaultController extends Controller
{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				//use 'contact' view from views/mail
				$mail = new YiiMailer('contact', array('message' => $model->body, 'name' => $model->name, 'description' => 'Contact form'));
				//render HTML mail, layout is set from config file or with $mail->setLayout('layoutName')
				$mail->render();
				//set properties as usually with PHPMailer
				$mail->From = $model->email;
				$mail->FromName = $model->name;
				$mail->Subject = $model->subject;
				$mail->AddAddress('red@school-discovery.ru');
				//send
				if ($mail->Send()) {
					$mail->ClearAddresses();
					Yii::app()->user->setFlash('contact',Yii::t('FeedbackModule.flash' ,'Thank you for contacting us. We will respond to you as soon as possible.'));
				} else {
					Yii::app()->user->setFlash('error','Error while sending email: '.$mail->ErrorInfo);
				}

				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
}