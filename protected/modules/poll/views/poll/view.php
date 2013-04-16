<?php
   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.poll.assets'));
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/vote.js');
?>

<div class="well block">
    <h2><?php echo CHtml::link(CHtml::encode($node->title), Yii::app()->createUrl($node->url)) ; ?></h2>
    <div class="meta">
        <p><i class="icon-user"></i><?php echo CHtml::encode(YumUser::getUsernameById($node->author)) ?></p>
    </div>
    <div class="article">
    <?php echo $node->content; ?>
    </div>
    <div class="poll alert alert-info" style="width:50%">
        <?php if(!$voted && !Yii::app()->user->isGuest && $state == 'active'): ?>
            <div class="variants">
                <?php foreach ($variants as $element): ?>
                    <span class="variant"> <input type="radio" name="poll-vote" value="<?php echo $element->id ?>" /> <label for="poll-vote"><?php echo $element->text; ?> </label></span><br/>
                <?php endforeach; ?>
            </div>
            <button class="btn btn-primary" id="vote-button" style="margin-top:10px;"><?php echo Yii::t('PollModule.admin', 'Vote'); ?></button>
        <?php elseif ($state == 'future'):?>
            <?php echo Yii::t('PollModule.admin', 'Poll isn\'t began'); ?>
        <?php else: ?>
            <?php $this->renderPartial('_results', array('data' => $data)); ?>
        <?php endif;?>
    </div>
</div>


<style>
    label{
        display: inline !important;
    }
</style>
<script lang="javascript">
    var ajaxUrl = "<?php echo Yii::app()->createUrl('poll/poll/vote'); ?>";
</script>