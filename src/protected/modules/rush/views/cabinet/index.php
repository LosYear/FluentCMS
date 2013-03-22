<?php
/* @var $this CabinetController */

    $this->breadcrumbs=array(
            'Cabinet',
    );
    
    $this->menu = array(
        array('label' => Yii::t('RushModule.cabinet', 'Olympiad')),
        array('label' => Yii::t('RushModule.cabinet', 'All tours'), 'url' => Yii::app()->createUrl('rush/cabinet/all'), 'icon' => 'road'),
        array('label' => Yii::t('RushModule.cabinet', 'Active tours'), 'url' => Yii::app()->createUrl('rush/cabinet/active'), 'icon' => 'time'),
        array('label' => Yii::t('RushModule.cabinet', 'Results'), 'url' => Yii::app()->createUrl('rush/cabinet/results'), 'icon' => 'tasks'),
    );

   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/cabinet.css');

?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>$this->menu)); ?>
    </div>
    <div class="span9 well block">
        <div class="page-header">
          <h1><?php echo Yii::t("RushModule.cabinet", 'Cabinet'); ?> <small><?php echo Yii::t("RushModule.cabinet", 'Welcome'); ?></small></h1>
        </div>
        
        <p>Личный кабинет является основной частью сайта. Все действия, касающиеся олимпиады и Вас в целом, Вы можете совершить здесь.</p>
        
        <p>На данный момент количество активных туров: <span class="label label-info">X</span> <br/>
        Более подробную информацию об активных турах Вы можете
        увидеть в разделе <code><i class="icon-fire"></i> Олимпиада</code> <i class="icon-chevron-right"></i> <code><i class="icon-time"></i> Активные туры</code>
        </p>
        
        <p>Ваши результаты можно увидеть в разделе <code><i class="icon-fire"></i> Олимпиада</code> <i class="icon-chevron-right"></i> <code><i class="icon-tasks"></i> Результаты</code>.
            Результаты блиц туров появляются в этом разделе сразу, после прохождения тура.
            После прохождения тура с развернутыми ответами Вы можете отслеживать статус вашего
            решения. Пожалуйста, проявите терпение, в отличии от блиц тура, решения тура с развернутыми ответами проверяет живой человек. По завершению проверки, Вы можете увидеть количество баллов,полученное Вами в данном туре.
            Решение для тура с развернутыми ответами должно находится <strong>в одном файле</strong>, имеющем формат .doc(x).
            После отправки решения, Вы <strong>не сможете загрузить новое или поменять старое</strong>.
            При прохождении блиц тура следует обратить внимание, что у Вас <strong>не будет возможности вернуться на предыдущий вопрос</strong>.
        </p>
        
        <p>Все участники хотят знать друг о друге, поэтому, пожалуйста, если Вы еще не заполнили информацию о своей команде, 
            то Вы можете сделать это в разделе <code><i class="icon-user"></i> Профиль</code>.
            Список всех команд Вы можете увидеть в разделе "Команды".
        </p>
        
        <p>Если у Вас возникли вопросы, Вы можете связаться с админстрацией в разделе <code><i class="icon-envelope"></i> Сообщения</code>.
            Также, в данном разделе Вы можете общаться с участниками других команд.
            Пожалуйста, обратите внимание, что при возникновении технических проблем, Вам нужно предоставить подробную информацию о проблеме: информацию о системе, название и версию браузера, действия, предшествующие возникшей проблеме. Для того, чтобы сообщить о возникшей проблеме достаточно одного раза. Не стоит дублировать сообщения несколько раз.
        </p>
        
        <p>После окончания олимпиады в разделе <code><i class="icon-certificate"></i> Сертификаты</code> появятся грамоты в электронном варианте.
            Вы сможете скачать их в любое время.
        </p>
    </div>
  </div>
</div>