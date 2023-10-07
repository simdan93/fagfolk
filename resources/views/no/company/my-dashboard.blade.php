@extends('no.layouts.company_dashboard')
@section('title', 'Dashboard')
@section('page_heading','Dashboard')

@section('dashboard-content')
	@if($companyDetailsExists == null)
		<p>Fant ingen selskaper registrert. Gratulerer du er den første! </p>
	@endif

	@if($companyDetails == null || $payAdress == null || $officeAdress == null)
		@if($companyDetails == null)
			<a href="{{ route('company.fillInfo') }}">Fyll inn selskapsopplysninger</a>
		@endif
	@else
		@if(session()->has('registrationComplete'))
			<div class="alert alert-success">
				{{ session()->get('registrationComplete') }}
			</div>
		@elseif(session()->has('detailsRegistered'))
			<div class="alert alert-success">
				{{ session()->get('detailsRegistered') }}
			</div>
		@elseif(session()->has('detailsUpdated'))
			<div class="alert alert-success">
				{{ session()->get('detailsUpdated') }}
			</div>
		@elseif(session()->has('serviceAdded'))
			<div class="alert alert-success">
				{{ session()->get('serviceAdded') }}
			</div>
		@elseif(session()->has('serviceUpdated'))
			<div class="alert alert-success">
				{{ session()->get('serviceUpdated') }}
			</div>
		@elseif(session()->has('serviceDeleted'))
			<div class="alert alert-success">
				{{ session()->get('serviceDeleted') }}
			</div>
		@elseif(session()->has('mailSent'))
			<div class="alert alert-success">
				{{ session()->get('mailSent') }}
			</div>
		@elseif(session()->has('mailNotSent'))
			<div class="alert alert-failure">
				{{ session()->get('mailNotSent') }}
			</div>
		@endif
		<div class="panel panel-default">
		<div class="panel-heading">Arbeidsområde</div>
			<div class="panel-body">
				@if(isset($companyWorkAreas) and !empty($companyWorkAreas))
				<p>
					<b>Postnr: </b>{{ $companyWorkAreas[0]->postnummer }}
				</p>
				@else
				<p>
					<b>Ingen arbeidsområde registrert, <a href="{{ route('company.fillWorkAreaInfo') }}">Klikk her for å registrere</a>
				</p>
				@endif
			</div>
		</div>
<!--
		<div class="panel panel-default">
		<div class="panel-heading">Servicer</div>
			<div class="panel-body">
				@if($companyServices == null)
					<p>Ingen services registrert</p>
				@else
					@php ($IDCount = 1)
					@foreach ($companyServices as $service)
						@if($IDCount > 3)
							<p>[Resten av listen ligger i paneret: "Mine servicer"]</p>
							@break;
						@else
							<div class="serviceBox">
								<p><b>Hovedfag: </b>{{ $service->mainservice_id }} | <b>Spesialisering: </b>{{ $service->secondaryservice_id }}
								<p><b>Timepris: </b>{{ $service->timepris }} </p>
								<p><b>Oppmøtepris: </b>{{ $service->oppmøtepris }}</p>
							</div>
						@endif
						@php ($IDCount += 1)
					@endforeach
				@endif
			</div>
		</div>
	-->
	@endif
@stop

@section('right-sidebar-content')
@stop

@section('scripts')
<script src="/js/moreInfoRequest.js"></script>
<script src="/js/getResponseMsg.js"></script>
@stop
