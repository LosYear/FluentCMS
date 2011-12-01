$(document).ready( function(){
	check_newMsg();
});

function check_newMsg(){
	messages = -1; // Number of new messages
	
	$.ajax({
		url : "plugins/messages/getNotify.php",
		type : "POST",
		success : function (data, textStatus, jqXHR){
			formData = eval ("(" + data + ")"); // Making normal data format
						
			messages = formData.newMsg;
			if ( messages != 0 ){
				$.notification('У Вас есть непрочитанные личные сообщения!', {
					className: 'jquery-notification',
					duration: 5000,
					freezeOnHover: true,
					hideSpeed: 250,
					position: 'bottom-right',
					showSpeed: 250,
					zIndex: 99999
				});
			}
		}
	});
};