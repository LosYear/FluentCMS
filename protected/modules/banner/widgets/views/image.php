<?php $id = "banner-".$model->name."-".$model->id;
    $file = Yii::app()->homeUrl.'/resources/uploads/banners/'.$model->name.'.'.pathinfo($model->file, PATHINFO_EXTENSION)
?>
<div class="banner-block" id="<?= $id ?>">
    <a href="<?= $model->href ?>" <?php if($model->new_window): ?>target="_blank"<?php endif; ?>>
        <img src="<?= $file ?>" />
    </a>
</div>

<script lang="javascript">
    $('#<?= $id ?>').click(function(){
            $.ajax({
               url: "<?= Yii::app()->createUrl('banner/banner/incrementClicks', array('id' => $model->id))?>"
            });
        }
    );
</script>