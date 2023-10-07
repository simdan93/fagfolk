@extends('no.layouts.user_dashboard')
@section('title', 'Konfigurasjoner')
@section('page_heading','Konfigurasjoner')

@section('dashboard-content')
	@if(session()->has('detailsUpdated'))
		<div class="alert alert-success">
			{{ session()->get('detailsUpdated') }}
		</div>
	@endif
	@if(session()->has('AddressesCreated'))
		<div class="alert alert-success">
			{{ session()->get('AddressesCreated') }}
		</div>
	@endif
	@if(session()->has('AddressesUpdated'))
		<div class="alert alert-success">
			{{ session()->get('AddressesUpdated') }}
		</div>
	@endif
	<div class="panel panel-default">
		<div class="panel-heading">Mine detaljer</div>
		<div class="panel-body">
			<p>Fullt navn: {{ $userDetails[0]->navn }} {{ $userDetails[0]->etternavn }}</p>
			<p>Født: {{ $userDetails[0]->alder }}</p>
			<p>Telefon: {{ $userDetails[0]->telefon }}</p>
			<p>Mobil: {{ $userDetails[0]->mobil }}</p>
			<p>Mail: {{ $userDetails[0]->email }}</p>
			<a href = '#' data-toggle="modal" data-target="#userDetailsUpdateModal"><strong>Rediger</strong></a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Addresser registrert</div>
		<div class="panel-body">
			@if($payAddress == null || $homeAddress == null)
				<a href="{{ route('user.register-addresses') }}">Registrer addresser</a>
			@else
				<h4>Hjem</h4>
				<p>{{ $homeAddress[0]->addresse }}</p>
				<p>{{ $homeAddress[0]->postnummer }}, {{ $homeAddress[0]->sted }}</p>
				<h4>Faktura</h4>
				<p>{{ $payAddress[0]->faktura_addresse }}</p>
				<p>{{ $payAddress[0]->faktura_postnummer }}, {{ $payAddress[0]->faktura_by }}</p>
				<p><a href="#" data-toggle="modal" data-target="#userAdressUpdateModal"><strong>Oppdater addresser</strong></a></p>
			@endif
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="userDetailsUpdateModal">
		<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="/no/bruker/mine-detaljer/oppdater-detaljer">
						{{ csrf_field() }}
						<div class="modal-header">
								<h3 class="modal-title">Oppdater opplysninger</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								@include('no.includes.forms.update_user_details')
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
	<div class="modal fade" id="userAdressUpdateModal">
		<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="/no/bruker/mine-detaljer/oppdater-addresser">
						{{ csrf_field() }}
						<div class="modal-header">
								<h3 class="modal-title">Oppdater addressene</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								@include('no.includes.forms.update_user_adresses')
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
								<button type="submit" class="btn btn-primary">Lagre endringer</button>
						</div>
					</form>
				</div>
		</div>
	</div>
@endsection

@section('right-sidebar-content')
@stop

@section('scripts')
<script>
	//Check checkbox if filled, if filled copy the home address to pay address fields
	function fillBilling(f)
	{
		if(f.billingBox.checked == true)
		{
			f.faktura_addresse.value = f.addresse.value;
			f.faktura_postnummer.value = f.postnummer.value;
			f.faktura_by.value = f.sted.value;
		}
	}
</script>
@stop
