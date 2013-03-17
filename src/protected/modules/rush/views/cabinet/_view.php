<?php
/* @var $this TourController */
/* @var $data Tour */

    $type = Tour::types()[$data->type];
    $date = DateTime::createFromFormat("Y-m-d G:i:s", $data->from);
    $from = $date->format("j") . " " . Yii::t('RushModule.date_parental',$date->format("F")) . " " . $date->format("Y") . " " . $date->format("G:i");
    
    $date = DateTime::createFromFormat("Y-m-d G:i:s", $data->till);
    $till = $date->format("j") . " " . Yii::t('RushModule.date_parental',$date->format("F")) . " " . $date->format("Y") . " " . $date->format("G:i");
?>

<div class="element">
    <h3><?php echo Category::dropDown()[$data->category_id] ?><b> / </b>
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