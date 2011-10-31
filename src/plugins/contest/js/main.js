var tour_id = 0;
var number = 0;
var t;

$(document).ready(function() {
	tour_id = 2;
	number = 0;
	display_question();
});

function display_question()
{
	number ++;
	value = $('input[name=ans]:checked').val();
	
	if(!value)
		value = 'undef';
	$.ajax({url:"plugins/contest/changeQue.php",
			type:"POST",
			data:{tour_id:tour_id,question:number,ans:value},
			success:function(result,status,xhr){
				clearTimeout(t);
				obj = eval ("(" + result + ")");
				if(obj.mode == "quest")
				{
					$("div.container").html('');
					$('<label></label>').html(obj.que).appendTo("div.container");
					$('<br/>').html('').appendTo("div.container");
					$(obj.answs).each(function(index)
					{
						$('<input type="radio" value="' + (index + 1) + '" name="ans"/>').html('').appendTo("div.container");
						$('<span></span>').html('   ' + obj.answs[index].ans).appendTo("div.container");
						$('<br/>').html('').appendTo("div.container");
					});
					$('<br/>').html('').appendTo("div.container");
					$('<button type=\"button\" style=\"width:50px\" onclick=\"next();\" id=\"ok\"></button>').html('OK').appendTo("div.container");
					t = setTimeout("next()",10000); // >>> Переменную писать сюда!!! <<<
				}
				else if(obj.mode == "result")
					$("div.container").html(obj.text);
			},
			error:function(xhr){
				clearTimeout(t);
				$("div.container").html("Произошла ошибка: <br/>" + xhr.status + " " + xhr.statusText + "<br/>Попробуйте перезагрузить страницу");
			}
	});
}

function next(){
	display_question();
}
