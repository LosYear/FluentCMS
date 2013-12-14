$(document).ready(function(){
   $('#vote-button').click(function(){
       var answer = $('input:radio[name=poll-vote]:checked').val();
       
       $.ajax({
           url : ajaxUrl,
           data : {id : answer},
           dataType : 'html',
           type : 'POST',
       }).done(function(data){
           $('.poll').html(data);
       });
   }); 
});