$(document).ready(function() {
	tour_id = 2;
	number = 0;
	number++;
	$("div.container").load('plugins/contest/changeQue.php',{id:tour_id , question:number});
});
