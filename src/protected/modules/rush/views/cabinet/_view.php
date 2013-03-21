<?php
/* @var $this TourController */
/* @var $data Tour */

    $tmp = Tour::types();
    $type = $tmp[$data->type];
    
    $from = Yii::app()->dateFormatter->formatDateTime($data->from, 'long', 'short');

    $till = Yii::app()->dateFormatter->formatDateTime($data->till, 'long', 'short');
?>

<div class="element">
    <h3><?php $tmp = Category::dropDown(); echo $tmp[$data->category_id] ?><b> / </b>
        <a href="<?php echo Yii::app()->createUrl('rush/cabinet/view', array('id' => $data->id) )?>"><?php echo $data->name ?></a></h3>
    
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$data,
    'attributes'=>array(
        array('name'=>'description', 'label'=>Yii::t('RushModule.cabinet', 'Description')),
        array('name'=>'type', 'label'=>Yii::t('RushModule.cabinet', 'Type'), 'value'=>$type),
        array('name'=>'from', 'label'=>Yii::t('RushModule.cabinet', 'From'), 'value' => $from),
        array('name'=>'till', 'label'=>Yii::t('RushModule.cabinet', 'Till'), 'value' => $till),
    ),
)); ?>

</div>