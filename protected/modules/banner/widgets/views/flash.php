<?php $id = "banner-" . $model->name . "-" . $model->id;
$file = Yii::app()->homeUrl . '/resources/uploads/banners/' . $model->name . '.' . pathinfo($model->file, PATHINFO_EXTENSION)
?>
<div class="banner-block" id="<?= $id ?>">
    <a href="<?= $model->href ?>" <?php if ($model->new_window): ?>target="_blank"<?php endif; ?>>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                codebase="http://fpdownload.macromedia.com/
pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">
            <param name="movie" value="<?= $file ?>"/>
            <embed type="application/x-shockwave-flash" src="<?= $file ?>"
                   pluginspage="http://www.macromedia.com/go/getflashplayer"/>
        </object>
    </a>
</div>

<script lang="javascript">
    $('#<?= $id ?>').click(function () {
            $.ajax({
                url: "<?= Yii::app()->createUrl('banner/banner/incrementClicks', array('id' => $model->id))?>"
            });
        }
    );
</script>