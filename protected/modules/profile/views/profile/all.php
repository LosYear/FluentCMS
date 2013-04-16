<ul class="thumbnails">
    <?php foreach($data as $user): ?>
        <li class="span4">
            <div class="thumbnail">
                <?php $criteria = new CDbCriteria; $criteria->condition = 'id = :id'; $criteria->params = array('id' => $user->user_id);
                $tmp = $model->find($criteria); echo $tmp->getAvatar();?>
                <div class="caption">
                    <h3><?php echo $user->name; ?></h3>
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
    
    .block{
        padding-left: 0;
    }
    
    .span4{
       /* margin-left:0 !important;*/
    }
</style>