@extends('no.layouts.company_dashboard')
@section('title', 'Responser fra kunder')
@section('page_heading','Responser fra kunder')

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


	<div class="panel panel-default">
		<div class="panel-heading">Private kunder</div>
		<div class="panel-body">
			@if($responseInfoToUsers == null)
				<p>Ingen forespørseler respondert på</p>
			@else
				@foreach ($responseInfoToUsers as $responseInfoToUser)
					<div class="standardBox">
						<p><b>Kunde: </b>{{ $responseInfoToUser->navn }} {{ $responseInfoToUser->etternavn }}  </p>
						<p>Søker:</p>
						@if(isset( $responseInfoToUser->alder ))
							<p>Alder: {{ $responseInfoToUser->navn }} {{ $responseInfoToUser->etternavn }} </p>
						@endif
						<p>
							<b>Hovedfag: </b> {{ $responseInfoToUser->mainservice_id }}  <b>Spesialisering: </b> {{ $responseInfoToUser->secondaryservice_id }}
						</p>
						<div class="workarea">
							<p><b>Prosjektområde: </b>{{ $responseInfoToUser->postnummer }}</p>
						</div>
						@if($responseInfoToUser->befaring == 1)
							<p><b>Type:</b> Befaring</p>
						@else
							<p><b>Type:</b> Timebestilling</p>
						@endif
						<p><b>Oppsummert: </b>{{$responseInfoToUser->oppsummering}}</p>
						<p>--</p>
						<p><b>Melding til forespørrer: </b>{{$responseInfoToUser->response_message}}</p>
						<p><b>Status: </b>
						@if($responseInfoToUser->akseptert == false)
							Venter svar</p>
						@else
							Akseptert</p>
							<hr>
							<p><b style="color: green">Email til kunde: </b>{{ $responseInfoToUser->email }}</p>
							<p><b style="color: green">Mobilnr til kunde: </b>{{ $responseInfoToUser->mobil }}</p>
						@endif
					</div>
				@endforeach
			@endif
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">Selskaper</div>
		<div class="panel-body">
			@if($responseInfoToCompanies == null)
				<p>Ingen forespørseler respondert på</p>
			@else
				@foreach ($responseInfoToCompanies as $responseInfoToCompany)
					<div class="standardBox">
						<p>
							<b>Hovedfag: </b> {{ $responseInfoToCompany->mainservice_id }}  <b>Spesialisering: </b> {{ $responseInfoToCompany->secondaryservice_id }}
						</p>
						<div class="workarea">
							<p><b>Prosjektområde: </b>{{ $responseInfoToCompany->postnummer }}</p>
						</div>
						@if($responseInfoToCompany->befaring == 1)
							<p><b>Type:</b> Befaring</p>
						@else
							<p><b>Type:</b> Timebestilling</p>
						@endif
						<p><b>Oppsummert: </b>{{$responseInfoToCompany->oppsummering}}</p>
						<p>--</p>
						<p><b>Melding til forespørrer: </b>{{$responseInfoToCompany->response_message}}</p>
						<p><b>Status: </b>
						@if($responseInfoToCompany->gyldig == false)
							Ugyldig</p>
						@elseif($responseInfoToCompany->akseptert == false)
							Venter svar</p>
						@else
							Akseptert</p>
							<hr>
							<p><b style="color: green">Email til selskap: </b>{{ $responseInfoToCompany->email }}</p>
							<p><b style="color: green">Mobilnr til selskap: </b>{{ $responseInfoToCompany->mobil }}</p>
						@endif
					</div>
				@endforeach
			@endif
		</div>
	</div>
@stop

@section('right-sidebar-content')
@stop

@section('scripts')
<script src="/js/getResponseMsg.js"></script>
@stop
