@include('css_default_imports')


	<div id="container">
		<form id = "loginForm" class="form-horizontal" role="form">
			{!! csrf_field() !!}

			<div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">E-mail/Username</label>

				<div class="col-md-6">
					<input id="login-textbox"type="login" class="form-control" name="login" value="{{ old('login') }}">
					<p class="error-text" id="login-message"></>
					@if ($errors->has('login'))
						<span id="span-login' class="help-block">
							<strong>{{ $errors->first('login') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label class="col-md-4 control-label">Password</label>

				<div class="col-md-6">
					<input type="password" class="form-control" name="password">
					<p class="error-text" id="password-message"></>
					@if ($errors->has('password'))
						<span id="span-password" class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> Remember Me
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button id="main-login-btn" type="submit" class="btn btn-primary">
						<i class="fa fa-btn fa-sign-in"></i>Login
					</button>
					<a id="facebook-login-btn" class="btn btn-social btn-facebook"  href="#">
						<span class="fa fa-facebook"></span> Login via facebook
					</a>
					<a class="label label-info" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
				</div>
			</div>
		</form>
	</div>


<script src="{{ asset('js/login.js') }}"></script>

