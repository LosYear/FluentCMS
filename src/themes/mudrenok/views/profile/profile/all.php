<ul class="thumbnails">
    <?php foreach($data as $user): ?>
        <li class="span4">
            <div class="thumbnail">
                <?php $criteria = new CDbCriteria; $criteria->condition = 'id = :id'; $criteria->params = array('id' => $user->user_id);
                $tmp = $model->find($criteria); echo $tmp->getAvatar();?>
                <div class="caption">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile/profile/view', array('id' => $user->user_id)); ?>"><?php echo $user->name; ?></a></h3>
                    <a class="geo"><?php echo $user->city.", ".$user->school; ?></a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<style>
    .avatar{
        text-align: center;
        margin: 0px;
        float: none;
    }    
    .thumbnail{
        text-align: center;
        background: #fff;
    }
    
    #geo{
        float:right;
    }
    
 /*   .block{
        padding-left: 0;
    }*/
    .first-in-row { margin-left: 0 !important; }
</style>

<script lang="javascript">
    /**
 * Adds 0 left margin to the first thumbnail on each row that don't get it via CSS rules.
 * Recall the function when the floating of the elements changed.
 */
function fixThumbnailMargins() {
    $('.row-fluid .thumbnails').each(function () {
        var $thumbnails = $(this).children(),
            previousOffsetLeft = $thumbnails.first().offset().left;
        $thumbnails.removeClass('first-in-row');
        $thumbnails.first().addClass('first-in-row');
        $thumbnails.each(function () {
            var $thumbnail = $(this),
                offsetLeft = $thumbnail.offset().left;
            if (offsetLeft < previousOffsetLeft) {
                $thumbnail.addClass('first-in-row');
            }
            previousOffsetLeft = offsetLeft;
        });
    });
}

// Fix the margins when potentally the floating changed
$(window).resize(fixThumbnailMargins);

fixThumbnailMargins();
</script>