$(function() {
	$( "#accordion" ).accordion();
	jQuery.get('uploadScript_JQUERY.txt', function(data) {
	   //process text file line by line
	   $('#section1').html(data.replace('n',''));
	});
	jQuery.get('uploadScript_CSS.txt', function(data) {
	   //process text file line by line
	   $('#section2').html(data.replace('n',''));
	});
});