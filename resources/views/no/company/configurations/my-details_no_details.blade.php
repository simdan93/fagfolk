@extends('no.layouts.company_dashboard')
@section('title', 'Konfigurasjoner')
@section('page_heading','Konfigurasjoner')

@section('dashboard-content')
	@if(session()->has('detailsRegistered'))
		<div class="alert alert-success">
			{{ session()->get('detailsRegistered') }}
		</div>
	@elseif(session()->has('detailsUpdated'))
		<div class="alert alert-success">
			{{ session()->get('detailsUpdated') }}
		</div>
	@endif
	<div class="panel panel-default">
		<div class="panel-heading">Selskapsdetaljer</div>
		<div class="panel-body">
			<a href="{{ route('company.register.submit') }}">Registrer detaljer</a>
		</div>
	</div>
	<div class="panel panel-default">
  	<div class="panel-heading">Addresser registrert</div>
		<div class="panel-body">
			<a href="{{ route('company.register-addresses') }}">Registrer addresser</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Fakturaopplysninger</div>
		<div class="panel-body">
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Dashboard konfiguasjon</div>
		<div class="panel-body">
		</div>
	</div>
@stop

@section('scripts')
<script>
	function fillBillingCompany(f)
	{
		if(f.billingBox.checked == true)
		{
			f.faktura_addresse.value = f.kontor_addresse.value;
			f.faktura_postnummer.value = f.kontor_postnummer.value;
			f.faktura_by.value = f.kontor_by.value;
		}
	}
</script>
@stop
