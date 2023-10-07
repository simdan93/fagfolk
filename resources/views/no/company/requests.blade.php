@extends('no.layouts.company_dashboard')
@section('title', 'Forespørseler')
@section('page_heading','Forespørseler')

@section('dashboard-content')
	<!-- TODO: Legg til ignore/slett forespørsel-->
	<h2>Brukere</h2>
	@if($validUserNeeds == null)
		<p>Ingen flere forespørseler</p>
	@else
		<div class="users_box">
			@php ($IDCount = 1)
			@foreach ($validUserNeeds as $need)
				<div class="standardBox" style="border:1px solid black;">
					<p>
						{{ $need->navn }} {{ $need->etternavn }}
					</p>
					<p>
						{{ $need->oppsummering }}
					</p>
					<div class="workarea">
						<p>{{ $need->postnummer }}</p>
					</div>
					@if($need->befaring == true)
						<p>Befaring</p>
					@endif
					@if($need->gyldig == false)
						<p><b>Ikke lenger gyldig</b></p>
					@else
						<button id="{{ $IDCount }}" type="button" value="{{ $need->id }}" class="btn btn-success acceptRequest">Aksepter</button>
					@endif
					<button id="{{ $IDCount }}" type="button" value="{{ $need->id }}" class="btn btn-warning moreInfoButtonUser">More info</button>

					<div class="moreInfoUser{{ $IDCount }}" style="display:none;">
						<p class="resultTilgjengelig"></p>
						<p class="resultOppsummering"></p>
						<p class="resultBeskrivelse"></p>
					</div>

					<div class="acceptRequest{{ $IDCount }}" style="display:none;">
					</div>
				</div>
				@php ($IDCount += 1)
			@endforeach
		</div>
	@endif


	<h2>Selskaper</h2>
	@if($validCompanyNeeds == null)
		<p>Ingen flere forespørseler</p>
	@else
		<div class="company_box">
			@php ($IDCount = 1)
			@foreach ($validCompanyNeeds as $need)
				<div class="standardBox" style="border:1px solid black;">
					<p>
						{{ $reqCompanyName[$IDCount-1] }}
					</p>
					<p>
						{{ $need->oppsummering }}
					</p>
					<div class="workarea">
						<p>{{ $need->postnummer }}</p>
					</div>
					@if($need->befaring == true)
						<p>Befaring</p>
					@endif
					@if($need->gyldig == false)
						<p><b>Ikke lenger gyldig</b></p>
					@else
						<button id="{{ $IDCount }}" type="button" value="{{ $need->id }}" class="btn btn-success acceptRequestCompany">Aksepter</button>
					@endif
					<button id="{{ $IDCount }}" type="button" value="{{ $need->id }}" class="btn btn-warning moreInfoButtonCompany">More info</button></td>

					<div class="moreInfoCompany{{ $IDCount }}" style="display:none;">
						<p class="resultTilgjengelig"></p>
						<p class="resultOppsummering"></p>
						<p class="resultBeskrivelse"></p>
					</div>

					<div class="acceptRequestCompany{{ $IDCount }}" style="display:none;">
					</div>
				</div>
				@php ($IDCount += 1)
			@endforeach
		</div>
	@endif
@endsection

@section('right-sidebar-content')
@stop

@section('scripts')
<script src="/js/company/moreInfoRequest.js"></script>
<script src="/js/company/acceptForm.js"></script>
@stop
