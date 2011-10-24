tour_id = 0;
number = 0;

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
	
	$("#ok").everyTime(30000, function() {
		$("#ok").click();
	});
}

function next(){
	display_question();
}
