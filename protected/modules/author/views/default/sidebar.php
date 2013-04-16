<div id="sidebar" class="well">
    <?php $this->widget('bootstrap.widgets.TbMenu', array(
        'type'=>'list',
        'items'=>MenuItemsController::getProfileItems(),
    )); ?>

</div>