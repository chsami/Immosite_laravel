<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    @include('css_default_imports')
</head>
<body id="app-layout">
	<img id="main-background" src="{{ asset('img/welcome_background2.jpg') }}">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
				<div id="MyDialogID"  title="My Dialog Title"></div>
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
					@if (Auth::guest())
						<li><a class="loginLink" href="{{ url('/home') }}">Home</a></li>	
					@else
						<li><a href="{{ url('/home') }}">Home</a></li>
					@endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a class="loginLink" href="" >Login</a></li>
                        <li><a class="registerLink" href="">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
	
    @yield('content')
	
	<!-- Modal -->
	<div id="mainModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">Modal Header</h4>
		  </div>
		  <div class="modal-body">
			<div id = "model-body-content">
			
			</div>
		  </div>
		</div>

	  </div>
	</div>
	
	@include('js_default_imports')
	
	@yield('page_scripts')
	
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
	
	@if ($errors->has('login') || $errors->has('password'))
		<script>
		$('h4').html('Login');
		$('#main-background').css('-webkit-filter', 'blur(5px)');
			$('#model-body-content').empty();
			$("#model-body-content").load( "/login #container", function() {
				$('#login-message').html("{{ $errors->first('login') }}");
				$('#password-message').html("{{ $errors->first('password') }}");
				$('#login-textbox').val("{{ old('login') }}");
			});
			$('#mainModal').modal();
		</script>
	@endif
</body>
</html>
