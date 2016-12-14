@extends('layout')

@section('title', '| login')

@section('content')

	<div class="row">

	  <div class="col-md-4 col-md-offset-4">

	    <div class="row">

	        <div class="col-md-12">

	            <a href="{{ url('google') }}" class="btn btn-lg btn-primary btn-block">

	                <strong>Login With Google</strong>

	            </a>

	        </div>

	    </div>

	  </div>

	</div>

@endsection