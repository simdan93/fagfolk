@extends('no.layouts.user_dashboard')
@section('title', 'Dashboard')
@section('page_heading','Dashboard')

@section('dashboard-content')
	@if(session()->has('mailNotSent'))
		<div class="alert alert-failure">
			{{ session()->get('mailNotSent') }}
		</div>
	@elseif(session()->has('mailSent'))
		<div class="alert alert-succsess">
			{{ session()->get('mailSent') }}
		</div>
	@endif
	@if(session()->has('registrationComplete'))
		<div class="alert alert-succsess">
			{{ session()->get('registrationComplete') }}
		</div>
	@endif
@stop

@section('right-sidebar-content')
@stop
