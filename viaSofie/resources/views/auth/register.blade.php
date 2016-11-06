

@include('css_default_imports')


<link rel="stylesheet" href="{{ asset('css/register.css') }}"

	<div id="container">
		<div id="notification"><p>test</p></div>
		<form id="registrationForm" class="form-horizontal" role="form">
			{!! csrf_field() !!}
			<label class="col-md-4 control-label">Persoonlijke gegevens</label>
			<br>
			<br>
			<label class="col-md-4 control-label">Aanspreektitel</label>
			<div class="form-group{{ $errors->has('salutation') ? ' has-error' : '' }}">
				<div class="col-md-4">
					{!! Form::select('salutation', array('Mijnheer' => 'Mijnheer', 'Mevrouw' => 'Mevrouw'), 'Mijnheer', array('class'=>'form-control custom-dropdown', 'id' => 'salutations')) !!}
					
					@if ($errors->has('salutation'))
						<span class="help-block">
							<strong>{{ $errors->first('salutation') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Gebruikersnaam</label>

				<div class="col-md-6">
					<input type="text" class="form-control" name="username" value="{{ old('username') }}">

					@if ($errors->has('username'))
						<span class="help-block">
							<strong>{{ $errors->first('username') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<!--<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Voornaam</label>

				<div class="col-md-6">
					<input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

					@if ($errors->has('firstname'))
						<span class="help-block">
							<strong>{{ $errors->first('firstname') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Achternaam</label>

				<div class="col-md-6">
					<input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

					@if ($errors->has('lastname'))
						<span class="help-block">
							<strong>{{ $errors->first('lastname') }}</strong>
						</span>
					@endif
				</div>
			</div> -->

			<div class="form-group{{ $errors->has('email_reg') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">E-Mail Address</label>

				<div class="col-md-6">
					<input type="text" class="form-control" name="email_reg" value="{{ old('email_reg') }}">

					@if ($errors->has('email_reg'))
						<span class="help-block">
							<strong>{{ $errors->first('email_reg') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<!--<div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">GSM</label>

				<div class="col-md-6">
					<input type="cellphone" class="form-control" name="cellphone" value="{{ old('cellphone') }}">

					@if ($errors->has('cellphone'))
						<span class="help-block">
							<strong>{{ $errors->first('cellphone') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<label class="col-md-4 control-label">Land</label>
			<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
				<div class="col-md-4">
				{{-- Form::select('country', null, null, array('class'=>'form-control custom-dropdown')) --}}
					
					@if ($errors->has('country'))
						<span class="help-block">
							<strong>{{ $errors->first('country') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Postcode</label>

				<div class="col-md-6">
					<input type="zipcode" class="form-control" name="zipcode" value="{{ old('zipcode') }}">

					@if ($errors->has('zipcode'))
						<span class="help-block">
							<strong>{{ $errors->first('zipcode') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Regio</label>

				<div class="col-md-6">
					<input type="region" class="form-control" name="region" value="{{ old('region') }}">

					@if ($errors->has('region'))
						<span class="help-block">
							<strong>{{ $errors->first('region') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Stad/Gemeente</label>

				<div class="col-md-6">
					<input type="city" class="form-control" name="city" value="{{ old('city') }}">

					@if ($errors->has('city'))
						<span class="help-block">
							<strong>{{ $errors->first('city') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Straat</label>

				<div class="col-md-6">
					<input type="street" class="form-control" name="street" value="{{ old('street') }}">

					@if ($errors->has('street'))
						<span class="help-block">
							<strong>{{ $errors->first('street') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Straatnummer</label>

				<div class="col-md-6">
					<input type="street_number" class="form-control" name="street_number" value="{{ old('street_number') }}">

					@if ($errors->has('street_number'))
						<span class="help-block">
							<strong>{{ $errors->first('street_number') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('mailbox') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Mailbox</label>

				<div class="col-md-6">
					<input type="mailbox" class="form-control" name="mailbox" value="{{ old('mailbox') }}">

					@if ($errors->has('mailbox'))
						<span class="help-block">
							<strong>{{ $errors->first('mailbox') }}</strong>
						</span>
					@endif
				</div>
			</div>-->
			

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Password</label>

				<div class="col-md-6">
					<input type="password" class="form-control" name="password">

					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Confirm Password</label>

				<div class="col-md-6">
					<input type="password" class="form-control" name="password_confirmation">

					@if ($errors->has('password_confirmation'))
						<span class="help-block">
							<strong>{{ $errors->first('password_confirmation') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('progress_bar') ? ' has-error' : '' }}">
				<label style = "display:none;" id="passwordStrength" class="col-md-4 control-label">Weak</label>
				<div class="col-md-6">
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-btn fa-user"></i>Registreer
					</button>
				</div>
			</div>
		</form>
	</div>
	
	<div id="errors">
	<p> </p>
	</div>
	<script src="{{ asset('js/register.js')}}"></script>
     <!-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6dnA6ePP9Iz1TfJ13g6ds-p9YqkUnsTA"> -->
	<script src='https://www.google.com/recaptcha/api.js'></script>

