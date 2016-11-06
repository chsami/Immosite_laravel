if (window.jQuery) {  
	$(document).ready(function() {
		var imagesPreview = function(input, placeToInsertImagePreview) {
			if (input.files) {
				var filesAmount = input.files.length;
				for (i = 0; i < filesAmount; i++) {
					var reader = new FileReader();
					reader.onload = function(event) {
						$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).attr('width', '100px').attr('height', '100px').addClass('small-image');
					}
					reader.readAsDataURL(input.files[i]);
				}
			}
		};
		$('#openFiles').on('change', function(e) {
				 imagesPreview(this, 'div.preview');
		});
		console.log("Upload.js loaded correctly.");
	});
} else {
	console.log("Jquery was not loaded :(");
}



function createImageUploadModule() {
	
}