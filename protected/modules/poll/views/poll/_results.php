<div class="results">
    <?php foreach($data as $element): ?>
    
       <div class="result">
            <?php echo $element['text'] ?>
            <div class="progress progress-success" style="">
                <div class="bar" style="width: <?php echo $element['percent'];?>%"></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>