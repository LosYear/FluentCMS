<?php
/* @var $this CabinetController */

    $this->breadcrumbs=array(
            'Cabinet',
    );
    
   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/cabinet.css');

?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>array())); ?>
    </div>
    <div class="span9 well block">
        <div class="page-header">
          <h1><?php echo Yii::t("RushModule.moderator", 'Cabinet'); ?> <small><?php echo Yii::t("RushModule.moderator", 'Welcome'); ?></small></h1>
        </div>
        
        <p>Для Вас, личный кабинет станет основной частью сайта. Именно здесь Вы будете выполнять основные свои функции.</p>
        
        <p>Бывают ситуации, когда у участников возникают вопросы.
            В эти моменты, они пишут Вам личные сообщения.
            Чтобы прочесть эти сообщения и ответить на них, Вы должны зайти в раздел <code><i class="icon-envelope"></i> Сообщения</code>.
            Также, в этом разделе Вы можете писать другим проверяющим или же общаться с участниками.
        </p>
        
        <p>Чтобы отследить текущую турнирную таблицу зайдите в раздел <code><i class="icon-tasks"></i> Результаты</code>.
            В этом разделе отображаются результаты блиц туров и результаты проверки туров с развернутыми ответами.
        </p>
        
        <p>
            Чтобы приступить к проверке решений пройдите в раздел <code><i class="icon-briefcase"></i> Решения</code>.
            Помните, вы в любой момент можете изменить результат проверки тура с развернутыми ответами. 
            Если к Вам обратился участник, с просьбой выдать ему подробные результаты прохождения блиц тура, 
            Вы можете увидеть их нажав иконку <code><i class="icon-eye-open"></i></code> рядом с количеством баллов.
        </p>
        
        <p>
            Многие пользователи, кроме бумажных вариантов грамот и сертификатов хотят иметь их электронные версии.
            Иногда возникают ситуации, когда у участника или у организатора нет возможности выслать материальный вариант.
            Управлять и загружать электорнными сертификатами вы можете в разделе <code><i class="icon-certificate"></i> Сертификаты</code>.
        </p>
    </div>
  </div>
</div>