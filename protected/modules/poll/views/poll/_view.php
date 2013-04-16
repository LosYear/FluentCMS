<?php
/* @var $this PollController */
/* @var $data Poll */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('node_id')); ?>:</b>
	<?php echo CHtml::encode($data->node_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isLimited')); ?>:</b>
	<?php echo CHtml::encode($data->isLimited); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from')); ?>:</b>
	<?php echo CHtml::encode($data->from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('till')); ?>:</b>
	<?php echo CHtml::encode($data->till); ?>
	<br />


</div>