@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">
				Welcome ditdat.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('js/welcome.js') }}"></script>