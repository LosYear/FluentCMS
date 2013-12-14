<?php
	/* @var $this ProfileController */
	/* @var $model Profile */
	/* @var $form CActiveForm */
?>

	<div class="form">
		<?php $form = $this->beginWidget('CActiveForm', array(
			'id' => 'profile-form',
			'enableAjaxValidation' => false,
			'htmlOptions' => array('class' => 'form-horizontal')
		)); ?>
		<?php echo $form->errorSummary($model); ?>
		<div class="form-group">
			<?= $form->label($model, 'name', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?= $form->textField($model, 'name', array('class' => 'name form-control')) ?>
			</div>
		</div>
		<div class="form-group">
			<?= $form->label($model, 'academic', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?= $form->dropDownList($model, 'academic', Academic::all(), array('class' => 'academic form-control')) ?>
			</div>
		</div>
		
		<div class="form-group">
			<?= $form->label($model, 'job', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?= $form->textField($model, 'job', array('class' => 'academic form-control')) ?>
			</div>
		</div>
		
		<div class="form-group">
			<?= $form->label($model, 'branch', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?= $form->dropDownList($model, 'branch', Branch::all(), array('class' => 'academic form-control')) ?>
			</div>
		</div>

		<div class="form-group">
			<?= $form->label($model, 'email', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?= $form->textField($model, 'email', array('class' => 'email form-control')) ?>
			</div>
		</div>


		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-2">
				<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
			</div>
		</div>
		<?php $this->endWidget(); ?>

	</div><!-- form -->

<?php if ($new): ?>
	<script lang="javascript">
		var labels = [];
		var mapped = {};
		var profile_data = {};

		var profile_id = -1;
		$('.name').typeahead({
			source: function (query, process) {
				profile_id = -1;
				$.ajax({
					url: "<?php echo Yii::app()->createUrl('author/ajax/profile'); ?>",
					data: {query: query},
					dataType: 'json',
					type: 'POST'
				}).done(function (data) {
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

			updater: function (item) {
				// Updating fields

				data = profile_data[item];
				profile_id = data.value;

				if (data.email != -1) {
					$('.email').val(data.email);
				}

				if (data.academy != -1) {
					$('.academic').val(data.academy);
				}
				return item;
			}
		});
		$('button').click(function () {
			if (profile_id != -1) {
				$('#profile-form').append('<input type="hidden" name="profile_id" id="profile_id" />');
				$('#profile_id').val(profile_id);
			}

			$('#profile-form').submit();
		});
	</script>
<?php endif; ?>