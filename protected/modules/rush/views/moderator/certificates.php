<?php
    $this->menu = array(
        array('label' => Yii::t('RushModule.moderator', 'Certificates')),
        array('label' => Yii::t('RushModule.moderator', 'Manage'), 'url' => Yii::app()->createUrl('rush/moderator/certificates'), 'icon' => 'list'),
        array('label' => Yii::t('RushModule.moderator', 'Upload certificate'), 'url' => Yii::app()->createUrl('rush/moderator/addCertificate'), 'icon' => 'upload'),
    );
    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
    });
    $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('block-grid', {
                    data: $(this).serialize()
            });
            return false;
    });
    ");
?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>$this->menu)); ?>
    </div>
    <div class="span9 well block">

    <div class="page-header">
        <h1><?php echo Yii::t('RushModule.moderator', 'Certificates'); ?></h1>
    </div>

        <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'id'=>'block-grid',
                'type'=>'striped bordered condensed',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'template'=>"{items}",
                'columns'=>array(
                        array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
                         array('name'=>'title','header'=>Yii::t('admin', 'Title'),),
                        array('name'=>'user_id', 'header'=>Yii::t('RushModule.moderator', 'User'),
                             'value' => 'YumProfile::getName($data->user_id)', 'filter' => YumProfile::dropDown()),
                        array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 40px'),
                            'template'=>'{remove}',
                            'buttons' => array(
                                'remove' => array(
                                    'icon' => 'trash',
                                    'label' => Yii::t('RushModule.moderator', 'Delete'),
                                    'url' => 'Yii::app()->createUrl("rush/moderator/deleteCertificate", array("id" => $data->id))',
                                ),
                            ),
                        ),
                ),
        )); ?>
    </div>
  </div>
</div>