var loginModalLoaded = false;
var registerModalLoaded = false;

var mainModal = "#mainModal";
var mainBackground = "#main-background";
var modelBodyContent = "#model-body-content";
var blurEffect = function(index, blurValue) {
	var arr = Array('-webkit-filter', 'blur(' + blurValue + 'px)');
	return arr[index];	
}


$( document ).ready(function() {
	$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
		options.async = true; //make the login and register page load async
	});
	$('.loginLink').on('click', function(event) {
		$('h4').html('Login');
		$(mainBackground).css(blurEffect(0, null), blurEffect(1, 5));
		if (loginModalLoaded == false) {
			$(modelBodyContent).empty();
			$(modelBodyContent).load( "login", function() {
				loginModalLoaded = true;
				registerModalLoaded = false;
			}, $(mainModal).modal());
		} else {
			$(mainModal).modal();
		}
		event.preventDefault();
	});
	
	$('.registerLink').on('click', function(event) {
		$('h4').html('Registreer');
		$(mainBackground).css(blurEffect(0, null), blurEffect(1, 5));
		if (registerModalLoaded == false) {
			$(modelBodyContent).empty();
			$(modelBodyContent).load( "/register", function() {
				registerModalLoaded = true;
				loginModalLoaded = false;
			}, $(mainModal).modal("show"));
		} else {
			$(mainModal).modal();
		}
		event.preventDefault();
	});	
	
	$(mainModal).on('hidden.bs.modal', function() {
		$(mainBackground).css(blurEffect(0, null), blurEffect(1, 0));
	})
	
	
	console.log("app.js loaded succesfully");
});