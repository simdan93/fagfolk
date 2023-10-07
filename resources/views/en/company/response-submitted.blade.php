@extends('layouts.master')
@section('title', 'Respons submitted')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">COMPANY Response submitted</div>
	<div class="panel-body">
		Your response has been sent back to user with your information</br>
		Click <a href="{{ route('company.dashboard') }}">here</a> to go back
	</div>
</div>
@endsection