<?php

class Subscription extends CFormModel {
    public $smtp;
    public $port;
    public $login;
    public $password;
    public $text;
    public $subject;
    public $sender;

    public function rules(){
        return array(
            array('text, subject, smtp, port, login, password, sender', 'required')
        );
    }

    public function attributeLabels(){
        return array(
            'smtp' => Yii::t('AuthorModule.admin', 'Server'),
            'port' => Yii::t('AuthorModule.admin', 'Port'),
            'login' => Yii::t('AuthorModule.admin', 'Login'),
            'password' => Yii::t('AuthorModule.admin', 'Password'),
            'text' => Yii::t('AuthorModule.admin', 'Text'),
            'subject' => Yii::t('AuthorModule.admin', 'Subject'),
            'sender' => Yii::t('AuthorModule.admin', 'Sender')
        );
    }
} 