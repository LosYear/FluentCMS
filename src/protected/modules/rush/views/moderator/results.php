<?php

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
    });
    $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('results-grid', {
                    data: $(this).serialize()
            });
            return false;
    });
    ");
?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>array())); ?>
    </div>
    <div class="span9 well block">

    <div class="page-header">
        <h1><?php echo Yii::t('RushModule.moderator', 'Results'); ?></h1>
    </div>

    <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'results-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'template'=>"{items}",
            'columns'=>array(
                    array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
                    //array('name' => 'category_id', 'header' => Yii::t('RushModule.moderator', 'Category')),
                    array('name' => 'tour_id', 'header' => Yii::t('RushModule.moderator', 'Tour'), 
                        'value' => 'Tour::dropDown()[$data->tour_id]', 'filter' => Tour::dropDown()),
                    array('name' => 'user_id', 'header' => Yii::t('RushModule.moderator', 'User'), 
                        'value' => 'YumUser::getUsernameById($data->user_id)', 'filter' => YumUser::dropDown()),
                    array('name' => 'points', 'header' => Yii::t('RushModule.moderator', 'Points'), 'filter'=>FALSE),
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'htmlOptions'=>array('style'=>'width: 40px'),
                        'template'=>'{result}',
                        'buttons' => array(
                            'result' => array(
                                'label' => Yii::t('RushModule.moderator', 'View'),
                                'url' => 'Yii::app()->createUrl("rush/moderator/viewresult", array("id"=>$data->id))',
                                'icon' => 'eye-open',
                                'visible' => '(Tour::getType($data->tour_id)=="test")',
                            ),
                        ), 
                    ),
                
            ),
    )); ?>
    </div>
  </div>
</div>