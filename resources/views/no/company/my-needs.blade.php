@extends('no.layouts.company_dashboard')
@section('title', 'Mine behov')
@section('page_heading','Mine behov')

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
	@if($companyNeeds == null)
		<p>Ingen behov</p>
	@else
			@php ($IDCount = 1)
			@foreach ($companyNeeds as $need)
				<div class="standardBox" style="padding: 5px;">
					<p>
						<b>Hovedfag:</b> {{ $need->mainservice_id }}
						<b>Spesialisering:</b> {{ $need->secondaryservice_id }}
					</p>
					<p><b>Sammendrag:</b> {{ $need->oppsummering }}</p>
					<div class="workarea">
						<p><b>Prosjektområde:</b> {{ $need->postnummer }}</p>
					</div>
					@if($need->befaring == 1)
						<p><b>Type:</b> Befaring</p>
					@else
						<p><b>Type:</b> Timebestilling</p>
					@endif
					<p>
						@if($need->gyldig == false)
							<b style="color: red">Ikke lenger gyldig</b>
						@else
							<b style="color: green">Gyldig</b>
							<p><button id="{{ $IDCount }}" type="button" value="{{ $need->id }}" class="btn btn-info moreInfoButtonCompany">Mer info</button></p>
							<a href= '/no/selskap/slett-hjelp/{{ $need->id }}'>Slett</a>
						@endif
					</p>

					<div class="moreInfoCompany{{ $IDCount }}" style="display:none;">
						<p class="resultTilgjengelig"></p>
						<p class="resultOppsummering"></p>
						<p class="resultBeskrivelse"></p>
					</div>
				</div>
				@php ($IDCount += 1)
			@endforeach
	@endif
@stop

@section('right-sidebar-content')
@stop

@section('scripts')
<script src="/js/moreInfoMyRequest.js"></script>
<script src="/js/getResponseMsg.js"></script>
@stop
