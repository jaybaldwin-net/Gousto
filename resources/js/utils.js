window.isset = function(value) {
	if(value != undefined && value != null) {
		return true;
	}
	else {
		return false;
	}
};

window.makeRequest = function(url, data, callback = function(){}, silent = false, method = 'POST'){
    $.ajax({
		url: url,
		type: method,
		data: data,
		dataType: 'json',
		cache: false,
		headers : {
			'X-CSRF-Token': $('body').data("token")
		},
		success: function (response) {
			callback(response);
		},
		error: function (error) {
			var result = {
				'success': false,
				'errors': ['an unknown error occurred']
			};
			if (isset(error.responseText)) {
				result.details = error.responseText;
			}
			callback(result);
		}
	});
}
