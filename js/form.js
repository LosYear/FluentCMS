$(document).ready(function(){
    $('[rel=popover]').each(function(){
        $(this).popover({
            trigger: 'hover'
        });
    })
});