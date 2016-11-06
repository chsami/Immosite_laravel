@extends('layouts.app')

<link href="{{  asset('css/script.css') }}" rel='stylesheet' type='text/css'>

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to my hidden script repo</div>
                <div class="panel-body">
                    <div id="accordion">
						  <h3>UploadScript JQuery</h3>
						  <div>
							<div id="section1">Basic Well</div>
						  </div>
						  <h3>UploadScript Css</h3>
						  <div>
							<div id="section2">Basic Well</div>
						  </div>
						  <h3>Section 3</h3>
						  <div>
							<div id="section3">Basic Well</div>
						  </div>
						  <h3>Section 4</h3>
						  <div>
							<div id="section4">Basic Well</div>
						  </div>
						<h3>Section 5</h3>
						  <div>
							<div class="well">Basic Well</div>
						  </div>
						</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('page_scripts')
<script src="{{  asset('js/script.js') }}"> </script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
@endsection