$(document).ready(function(){
    $('#send').click(function(){
        $('#myModal').modal('show');
    });
    
    $('#continue').click(function(){
        $('#continue').unbind('click');
        $('.modal-body').html('<form id="file-form" action="" method="POST" enctype="multipart/form-data"><input type="file" name="answer"/></form>');
        
        $('#continue').click(function(){
            $('form#file-form').submit();
        });
    });
});