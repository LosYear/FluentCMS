var labels = [];
var mapped = {};
var profile_data = {};

var profile_id = -1;
$('.name').typeahead({
	source : function (query, process){
		profile_id = -1;
		$.ajax({
			url : ajax_url,
			data : {query: query},
			dataType : 'json',
			type : 'POST'
		}).done(function(data){
				mapped = {};
				labels = [];
				profile_data = {};

				$.each(data.profiles, function (i, item) {
					mapped[item.label] = item.value;
					profile_data[item.label] = item;
					labels.push(item.label);
				});
				return process(labels);
			});
	},

	updater : function(item){
		// Updating fields

		data = profile_data[item];
		profile_id = data.value;

		if(data.email != -1 ){
			$('.email').val(data.email);
		}

		if(data.academy != -1){
			$('.academic').val(data.academy);
		}
		return item;
	}
});
$('button').click(function(){
	if(profile_id != -1){
		$('#profile-form').append('<input type="hidden" name="profile_id" id="profile_id" />');
		$('#profile_id').val(profile_id);
	}

	$('#profile-form').submit();
});