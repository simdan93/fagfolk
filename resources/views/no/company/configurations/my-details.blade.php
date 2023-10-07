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
			<p>Selskapsnavn: {{ $companyDetails[0]->selskap }} </p>
			<p>Organisasjonsnummer: {{ $companyDetails[0]->org_nummer }}</p>
			<a href = '#' data-toggle="modal" data-target="#detailsUpdateModal"><strong>Rediger</strong></a>
			<p class="workarea">
				Arbeidsområder:
				@foreach ($companyWorkAreas as $key => $companyWorkArea)
					 {{ $companyWorkArea->postnummer }}
				@endforeach
			</p>
			<a href = '#' data-toggle="modal" data-target="#workAreaUpdateModal"><strong>Rediger arbeidsområder</strong></a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Addresser registrert</div>
		<div class="panel-body">
			<h4>Kontoret</h4>
			<p>{{ $officeAdress[0]->kontor_addresse }}</p>
			<p>{{ $officeAdress[0]->kontor_postnummer }}, {{ $officeAdress[0]->kontor_by }}</p>
			<h4>Faktura</h4>
			<p>{{ $payAdress[0]->faktura_addresse }}</p>
			<p>{{ $payAdress[0]->faktura_postnummer }}, {{ $payAdress[0]->faktura_by }}</p>
			<p><a href="#" data-toggle="modal" data-target="#adressUpdateModal"><strong>Oppdater addresser</strong></a></p>
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

	<!-- Modal -->
	<div class="modal fade" id="detailsUpdateModal">
		<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="/no/selskap/konfigurasjoner/oppdater-detaljer">
						{{ csrf_field() }}
						<div class="modal-header">
								<h3 class="modal-title">Oppdater selskapsopplysninger</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								@include('no.includes.forms.update_company_details')
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
								<button type="submit" class="btn btn-primary">Lagre endringer</button>
						</div>
					</form>
				</div>
		</div>
	</div>
	<div class="modal fade" id="workAreaUpdateModal">
		<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="/no/selskap/konfigurasjoner/oppdater-arbeidsområder">
						{{ csrf_field() }}
						<div class="modal-header">
								<h3 class="modal-title">Oppdater arbeidsområder</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								@include('no.includes.forms.update_company_work_areas')
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
								<button type="submit" class="btn btn-primary">Lagre endringer</button>
						</div>
					</form>
				</div>
		</div>
	</div>
	<!-- Modal addresser -->
	<div class="modal fade" id="adressUpdateModal">
		<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="/no/selskap/konfigurasjoner/oppdater-addresser">
						{{ csrf_field() }}
						<div class="modal-header">
								<h3 class="modal-title">Oppdater addressene</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								@include('no.includes.forms.update_company_adresses')
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
								<button type="submit" class="btn btn-primary">Lagre endringer</button>
						</div>
					</form>
				</div>
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
