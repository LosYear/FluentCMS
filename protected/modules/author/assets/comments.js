$('#send-comment').click(function () {
	data = $('#comment-field').val();

	$.ajax({
		url: new_comment,
		type: "POST",
		data: {"comment": data, "id": article_id}
	}).done(function (data) {
			if (data != 'error') {
				// Comment added. Updating current page
				alert(data);

				$.fn.yiiListView.update('comments')

				$('#comment-field').val('');
			}
		});
});

function delete_comment(id) {
	$.ajax({
		url: delete_url,
		type: "POST",
		data: {"id": id}
	}).done(function (data) {
			$.fn.yiiListView.update('comments')
	});
}