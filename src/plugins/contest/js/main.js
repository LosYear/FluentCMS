tour_id = 0;
number = 0;
n = 1000;

$(document).ready(function() {
	tour_id = 2;
	number = 0;
	display_question();
});

function display_question()
{
	number ++;
	value = $('input[name=ans]:checked').val();
	$("div.container").load('plugins/contest/changeQue.php',{id:tour_id , question:number, ans:value});
	time = $('input[name=sec]').val();
	alert(time);
	$(document).everyTime(time, function() {
		$("#ok").click();
	});
}

function next(){
	display_question();
}
