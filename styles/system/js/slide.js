$(document).ready(function() {
	
	// Разворачиваем панель
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	// Сворачиваем панель
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Переключаем кнопки "Войти | Регистрация" на "Закрыть панель" при нажатии кнопки мыши
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
		
});