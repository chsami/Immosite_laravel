if (window.jQuery) {  
	$( document ).ready(function() {
		var loginForm = $("#loginForm");
		loginForm.submit(function(e) {
			console.log("clicked");
			e.preventDefault();
			//var formData = loginForm.serialize();
			var token = $('input[name=_token]').val();
			var login = $('input[name=login]').val() == "" ? "null" : $('input[name=login]').val();
			var password = $('input[name=password]').val() == "" ? "null" : $('input[name=password]').val();
			//console.log(token + " : " + login + " : " + password);
			$.ajax({
				url:'/login',
				type:'POST',
				//data:formData,
				data: {_token: token, login: login, password: password},
				success:function(data) {
					if (data.indexOf("credentials") > 0) {
						$('#login-message').html(data);
					} else {
						//window.location.replace("/");
						var newDoc = document.open();
						newDoc.write(data);
						newDoc.close();
						//window.document.replaceWith(data);
					}
					//console.log(data);
				},
				error: function (data) {
					console.log("error");
				}
			});
		});
		/*$('#facebook-login-btn').on('click', function() {
			console.log(document.URL);
			window.location = "/auth/facebook";
		});*/
		console.log("Login.js loaded succesfully.");
	});
} else {
	//window.location = "http://www.localhost:8000/";
}