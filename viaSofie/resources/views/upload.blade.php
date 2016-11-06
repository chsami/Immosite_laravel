@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/upload.css') }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Upload files</div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal">
						<input class="btn btn-info" type="file" id="openFiles" accept="image/*" multiple/>
						<br/>
						<div class="preview">
						<input id="btn-upload" type="button" class="btn btn-info" value="Upload"/>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script src="{{ asset('js/upload.js') }}"></script>
@endsection