<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <fieldset class="edit-form">
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'name span6')); ?></div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'academic'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'academic', array('class'=>'academic span6')); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'email'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'email', array('class'=>'email span6')); ?></div>
                </div>
            </div>
            

            <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
        </fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php if($new):?>
<script lang="javascript">
	var labels = [];
	var mapped = {};
	var profile_data = {};

	var profile_id = -1;
	$('.name').typeahead({
		source : function (query, process){
			profile_id = -1;
			$.ajax({
				url : "<?php echo Yii::app()->createUrl('author/ajax/profile'); ?>",
				data : {query: query},
				dataType : 'json',
				type : 'POST'
			}).done(function(data){
					mapped = {};
					labels = [];
					profile_data = {};

					$.each(data.profiles, function (i, item) {
						mapped[item.label] = item.value;
						profile_data[item.label] = item;
						labels.push(item.label);
					});
					return process(labels);
				});
		},

		updater : function(item){
			// Updating fields

			data = profile_data[item];
			profile_id = data.value;

			if(data.email != -1 ){
				$('.email').val(data.email);
			}

			if(data.academy != -1){
				$('.academic').val(data.academy);
			}
			return item;
		}
	});
	$('button').click(function(){
		if(profile_id != -1){
			$('#profile-form').append('<input type="hidden" name="profile_id" id="profile_id" />');
			$('#profile_id').val(profile_id);
		}

		$('#profile-form').submit();
	});
</script>
<?php endif; ?>