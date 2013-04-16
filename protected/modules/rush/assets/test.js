var current = 0; // Current question in human understanding
var ajaxUrl = '';
var tour_id = 0;
var buttonCaption = '';
var congratulations = '';
var points = '';
/**
 * Shows loader instead of div 'content'
 */
function showLoader(){
    $('.test-content').html('<div class="center" id="loader" src="/imgs/loader.gif" />');
}

/**
 * Displays next question
 * Increments current on first question, because php does current--
 */

function displayQuestion(){
    current++;
    $('#countdown').countDownStop();
    $('#countdown').remove();
    
    // Getting answer for current question
    var answer = $('input[name=ans]:checked').val();
    
    // If user can't answer current question
       if(!answer)
        answer = 'undef';
    
   // Ajax request
   showLoader();
   
   $.ajax({
        url : ajaxUrl,
        dataType : 'json',
        type : 'POST',
        data : {
            tour_id : tour_id, 
            question : current,
            answer : answer
        }
    }).done(function(data){
        // Our request is successful. Displaying new question if it exists
        //question = eval ("(" + data + ")");
        question = data;
        
        if (question.mode == 'test'){
            // Test continues. Displaying next question
            $('.test-content').html('');
            $('<div class="question"></div>').html(question.question).appendTo('.test-content');
            $('<div class="answers"></div>').html('').appendTo('.test-content');
            
            // Displaying possible answers
            $(question.answers).each(function(index){
                $('<div class="answer"></div>').html(
                    '<input type="radio" value="'+ (index+1) +'" name="ans" class="variant" /><label for="name" class="answer">'+unescape(question.answers[index])+'</label>'
                ).appendTo('.answers');
            });
            
            // Appending 'next' button
            $('<button style="margin-top:10px" id="next-question" class="btn btn-primary center" onclick="next()"/>').html(buttonCaption).appendTo('.test-content');
            $('body').append('<div style="padding-top:10px;" class="well well-small countdown-popup" id="countdown"></div>');
            $('#countdown').countDown({
                 startNumber: data.timeout,
                 callBack: function() {
                         next();
                 },
                 startFontSize : '36px',
                 endFontSize : '36px'
            });
            
            return false;
        }
            
        else if (question.mode == 'result'){
            // Test is ended. Showing results.
            $('.test-content').html('');
            $('<div class="alert alert-success center" id="results"></div>').html(congratulations + ' <span class="badge">' + question.points + '</span> ' + points).appendTo('.test-content');
        }
    });
}

/**
 * Function which change question. Simply executing 'DisplayQuestion'
 */
 
 function next(){
     displayQuestion();
     return false;
 }

$(document).ready(function(){
    current = 0;
    
    $('#start-button').click(function(){
        showLoader();
        next();
    });
});