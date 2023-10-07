@extends('no.layouts.company_dashboard')
@section('title', 'Respons registrert')
@section('page_heading','Respons registrert')

@section('dashboard-content')
<div class="panel panel-default">
	<div class="panel-heading">Respons registrert</div>
	<div class="panel-body">
		Dine respons har blitt sent til bruker med dine registrerte opplysninger</br>
		Trykk <a href="{{ route('company.dashboard') }}">her</a> for å gå tilbake.
	</div>
</div>
@endsection

@section('right-sidebar-content')
@stop
