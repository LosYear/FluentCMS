<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>
    <script lang="javascript">
        ajax_url = "<?php echo Yii::app()->createUrl('author/ajax/profile'); ?>";
    </script>
    <div class="form">
        <?php
        $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));
        Yii::app()->clientScript->registerScriptFile($assetsUrl . '/typeahead.min.js', CClientScript::POS_END);
        if($new){
            Yii::app()->clientScript->registerScriptFile($assetsUrl . '/profile_autocomplete.js', CClientScript::POS_END);
        }

        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'profile-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')
        )); ?>
        <?php echo $form->errorSummary($model); ?>


        <div class="form-group">
            <?= $form->label($model, 'email', array('class' => 'col-lg-2 control-label')) ?>
            <div class="col-lg-8">
                <?= $form->textField($model, 'email', array('class' => 'email form-control')) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-5    ">
                <button type="submit" class="btn btn-default"><?= Yii::t('journal', 'Change email') ?></button>
                <a href="<?= Yii::app()->createUrl('author/profile/resend') ?>" class="btn btn-success"><?= Yii::t('journal', 'Send confirmation') ?></a>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php if (true == false): ?>
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