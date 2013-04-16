 <li id="comment<?php echo $comment[id]?>">
    <div class="commentContent">
        <h6><?php echo $comment[name]?> <span><?php echo $comment[date_add]?></span> </h6>
        <div class="comment">
            <?php echo $comment[comment]?>
        </div>
        <a class="reply" href="#comment<?php echo $comment[id]?>">Ответить</a>
    </div>
    <?php if($comment[childs]) { ?>
        <ul id="commentsRoot<?php echo $comment[id]?>">
        <?php echo commentsString($comment[childs]) ?>
        </ul>
    <?php } ?>
</li>  
