$( document ).ready(function() {
	handleRegisterInput();
	validateForm();
	//loadUserPosition();
	passwordStrength();
	console.log( "register.js loaded correctly." );
});

//post when user presses the registration button
function sendAjaxPost() {
	const token = $('input[name=_token]').val();
	const email = $('input[name=email_reg]').val();
	const username = $('input[name=username]').val();
	const salutation = $( "#salutations option:selected" ).text();
	const password = $('input[name=password]').val();
	const password_confirmation = $('input[name=password_confirmation]').val();
	$.ajax({
		url:'/register',
		type:'POST',
		data: {_token: token, salutation: salutation, username: username, email: email, password: password, password_confirmation: password_confirmation},
		success:function(data) {
			//nothing went wrong, so we refresh our page
			var newDoc = document.open();
			newDoc.write(data);
			newDoc.close();
		},
		error: function (data, textStatus, jqXHR) {
			//something went wrong !
			//Convert Json format to array
			var arr = Object.keys(data.responseJSON).map(function(k){ 
				return data.responseJSON[k];
			});
			//init a errorText to concat multiple errors
			var errorText = "";
			//go through all the error messages and concat
			for(i = 0; i < arr.length; i++) {
				errorText += arr[i] + "\n";
			}
			//send the errorText to div paragraph
			$("#errors p").text(errorText);
		}
	});
}



function passwordStrength() {
	const progressClass = ".progress";
	const progressBar = ".progress-bar";
	$('form input').each(function() {
		if ($(this).attr('name') == "password") {
			$(this).keyup(function() {
				var strength = 0;
				
				if ($(this).val().match(/[0-9]/)) {
					strength += 20;
				}
				if ($(this).val().match(/(?=.*[a-z])(?=.*[A-Z])/)) {
					strength += 10;
				}
				if ($(this).val().length >= 6) {
					strength += 50;
				}
				if ($(this).val().length >= 12) {
					strength += 10;
				}
				if ($(this).val().match(/[-!$%^&*()_+@#|~=`{}\[\]:";'<>?,.\/]/)) {
					strength += 10;
				}
				if (strength > 100)
					strength = 100;
				
				var strengthText = "";
				var color = "";
				
				if (strength < 40) {
					strengthText = "Zwak";
					color = "red";
				} else if (strength >= 40 && strength <= 75) {
					strengthText = "Gemiddeld";
					color = "orange";
				} else {
					color = "green";
					strengthText = "Sterk";
				}
				if ($(progressClass).is(":hidden")) {
					$('#passwordStrength').show();
					$(progressClass).show();
				}		
				
				$(progressBar).css("background-color", color);
				$('#passwordStrength').text(strengthText);
				$(progressBar).css("width", strength + "%");
				$(progressBar).text(strength + "%");
			
			});
			
		}
	});
}


function loadUserPosition() {
	if (navigator.geolocation) {
	var geocoder = new google.maps.Geocoder;
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
	  geocodeLatLng(geocoder, position);//get address through latitude & longitude
    }, function() {
		console.log("Something went wrong, try again!");
    });
	} else {
		// Browser doesn't support Geolocation
		console.log("browser doesn't support");
	}
}
  


function geocodeLatLng(geocoder, position) {
  var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]) {
		$('form input').each(function() {
			switch($(this).attr('name')) {
				case 'zipcode':
					$(this).val(results[0]['address_components'][7]['long_name']);
					validationRules($(this));
				break;
				case 'region':
					$(this).val(results[0]['address_components'][4]['long_name']);
					validationRules($(this));
				break;
				case 'city':
					$(this).val(results[0]['address_components'][3]['long_name']);
					validationRules($(this));
				break;
				case 'street':
					$(this).val(results[0]['address_components'][1]['long_name']);
					validationRules($(this));
				break;
				case 'street_number':
					$(this).val(results[0]['address_components'][0]['long_name']);
					validationRules($(this));
				break;
			}
		});
		//dropdown smart fill
		$('.form-control').each(function() {
			if ($(this).attr('name') == 'country') {
				$(this).val(results[0]['address_components'][6]['short_name']);
			}
		});
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}

	

function validateForm() {	
	$('form').submit(function(event) {
		if (submitValidations() == false) {
			event.preventDefault();
		} else {
			sendAjaxPost();
			event.preventDefault();
		}
	});
}


function submitValidations() {
	var validation = false;
	$('form input').each(function() {
		validation = validationRules($(this)) == "correct" ? true : false;
		if (validation == false) {
			$(this).focus();
			return false;
		}
	});
	return validation;
}


function handleRegisterInput() {
	$('form input').each(function() {
		/*$(this).on('click', function() {
			validationRules($(this));
		});*/
		$(this).keyup(function() {
			validationRules($(this));
		});
	});
}

function validationRules(inputField) {
	switch(inputField.attr('name')) {
		case "username":
			return checkValidation(inputField, 6, 25, ['containsNumberValidationRequired']);
		/*case "firstname":
			return checkValidation(inputField, 2, 25, ['containsNumberValidationRequired']);
		case "lastname":
			return checkValidation(inputField, 2, 25, ['containsNumberValidationRequired']);*/
		case "email_reg":
			return checkValidation(inputField, 2, 30, ['emailValidationRequired']);
		/*case "cellphone":
			return checkValidation(inputField, 10, 20, ['phoneValidationRequired']);
		case "zipcode":
			return checkValidation(inputField, 4, 4, ['numberValidationRequired']); //belgium only
		case "region":
		case "city":
			return checkValidation(inputField, 2, 30, ['containsNumberValidationRequired']);
		case "street":
			return checkValidation(inputField, 2, 60, ['alphaNumericValidationRequired']); // alpha & numeric only
		case "street_number":
			return checkValidation(inputField, 1, 5, ['numberValidationRequired']);
		case "mailbox":
			return checkValidation(inputField, 0, 5, ['alphaNumericValidationRequired']);*/ // alpha & numeric only
		case "password_confirmation":
			return checkValidation(inputField, 6, 60, ['passwordMatchValidationRequired']); //check password = password_confirmation
		default:
			return "correct";
	}
}

function checkValidation(inputField, min, max, checkArray) {
	var isValid = "";
	//console.log();
	//inputField length check
	isValid = inputField.val().length >= min && inputField.val().length <= max ? "correct" : "Veld moet tussen " + min + " en " + max + " karakters bevatten.";
	//only check other fields if the inputField is still valid
	if (isValid == "correct") {
		checkArray.forEach(function(val) {
			if (val == "containsNumberValidationRequired") {
				isValid = !stringContainsNumber(inputField.val()) ? "correct" : "Veld kan geen getallen bevatten.";
			} else if (val == "emailValidationRequired") {
				isValid = isValidEmailAddress(inputField.val()) ? "correct" : "email address invalid";
			} else if (val == "phoneValidationRequired") {
				isValid = isValidCellphone(inputField.val()) ? "correct" : "geen geldig gsm nummer";
			} else if (val == "numberValidationRequired") {
				isValid = $.isNumeric(inputField.val()) ? "correct" : "textveld kan geen letters of symbolen bevatten.";
			} else if (val == "alphaNumericValidationRequired") {
				isValid = alphaNumericOnly(inputField.val()) ? "correct" : "textveld kan geen symbolen bevatten.";
			} else if (val == "passwordMatchValidationRequired") {
				isValid = checkPasswordMatch(inputField.val()) ? "correct" : "Wachtwoord komt niet overeen.";
			} else if (val == "TODO") {
				isValid = "correct";
			}
		});
	}
	//make a choose depending on the validation
	if (isValid == "correct") {
		inputField.removeClass('invalidInput');
		inputField.addClass('validInput');
		$('#notification').hide();
	} else {
		inputField.removeClass('validInput');
		inputField.addClass('invalidInput');
		showNotification(isValid, inputField.offset());
	}
	return isValid;
}

function checkPasswordMatch(text) {
	var validation = false;
	$('form input').each(function() {
		if ($(this).attr('name') == "password") {
			if ($(this).val() == text) {
				validation = true;
			} else {
				validation = false;
			}
		}
	});
	return validation;
}

function alphaNumericOnly(text) {
	console.log(text.indexOf(' '));
	return text != "" ? text.indexOf(' ') <= 0 : true;
}

function stringContainsNumber(text) {
	return text.match(/\d+/g) != null;
}

function isValidCellphone(phoneNumber) {
	return !phoneNumber.match(/[a-z]/);
}

//Credits to : http://so.devilmaycode.it/jquery-validate-e-mail-address-regex/
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}


function showNotification(error, position) {
	$('#notification').show();
	$('#notification p').text(error);
	$('#notification').offset(position);
	var x = $('#notification').offset();
	$('#notification').offset({top : x.top, left : x.left + 290});
}


