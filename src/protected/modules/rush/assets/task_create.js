var answers = 0;
var data;

function hideDiv(type){
    switch(type){
       case 'file' : {
           $('div#task-text-div').each(function(){$(this).hide();} );
           $('div#file-field-div').each(function(){$(this).show();});
           break;
       } 
       case 'question' : {
           $('div#task-text-div').each(function(){$(this).show();});
           $('div#file-field-div').each(function(){$(this).hide();});
           break;
       } 
   } 
}


$(document).ready(function(){
   var type = $('#task-type').val(); 
    
   hideDiv(type);
   $('#task-type').change(function(){
       type = $('#task-type').val(); 
       hideDiv(type);
   });
   
   if ($('#adv-hidden').val() != ''){
       var obj;
       var json = $('#adv-hidden').val();
       obj = eval('(' + json + ')');
       
       $('#points').val(obj.points);
       $('#time').val(obj.time);
       $('#right_answer').val(obj.right_answer);
       
       obj.answers.forEach(function(value){
            answers += 1;
           $('#answers').append('<div><input class="span5" id="answer" type="text" value="' + unescape(value) + '"><a href="#" id="answer-remove'+answers+'" class="icon-remove" > </a></div>');
           $('#answer-remove'+answers).click(function(){
                $(this).parent().remove();
                return false;
            });
       });
   }
    
   $('#answer-add').click(function(){
       answers += 1;
       $('#answers').append('<div><input class="span5" id="answer" type="text"><a href="#" id="answer-remove'+answers+'" class="icon-remove" > </a></div>');
       $('#answer-remove'+answers).click(function(){
           $(this).parent().remove();
           return false;
       });

       return false;
   });
   
   $('#task-form').submit(function(){
       if ($('#task-type').val() == "question"){
           // Serializing to JSON and writing to hidden field
           
           // Validating
           var texts = new Array();
           $('input#answer').each(function(){
               if($(this).val() != ''){
                    texts.push(escape($(this).val())); 
               }
           });
           data = {
             answers : texts,
             points : $('#points').val(),
             time : $('#time').val(),
             right_answer : $('#right_answer').val()
           };
           
           //generating json
           var json = $.toJSON(data);
           $('#adv-hidden').val(json);
       }       
   });
   
});