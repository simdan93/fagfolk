@extends('no.layouts.master')
@section('title', 'Hjem selskap')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		@if($companyDetails != null)
			Dashboard - {{ $companyDetails[0]->selskap }}
		@elseif($companyInfo[0]->navn != null)
			Dashboard - {{ $companyInfo[0]->navn }}
		@else
			Dashboard
		@endif
	</div>
	<div class="panel-body">
		@if($companyDetailsExists != null)
			<a href="{{ route('findHelpCompany') }}">Finn hjelp</a>
		@else
			<p>Fant ingen selskaper registrert. Gratulerer du er den første (og den eneste)! </p>
			<p>Registrer nå nedenfor.</p>
		@endif

		@if($companyDetails == null)
			<a href="{{ route('company.fillInfo') }}">Fyll inn selskapsopplysninger</a>
		@else
			<p><a href="{{ route('company.requests') }}">Kundeforespørseler</a> (som matcher dine servicer)</p>

			@if(session()->has('detailsRegistered'))
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

			<div id="company_info" >
				<h3>-- Selskapsopplysninger --</h3>
				<p>Selskapsnavn: {{ $companyDetails[0]->selskap }} </p>
				<p>Organisasjonsnummer: {{ $companyDetails[0]->org_nummer }}</p>
				<p class="workarea">
					Arbeidsområde: {{ $companyDetails[0]->postnummer }}
				</p>
				<a href = '/no/selskap/oppdater-detaljer'><strong>Rediger</strong></a>
			</div>

			<div id="company_services">
				<h3>-- Servicer --</h3>
				@if($companyServices == null)
					<a href = '/no/selskap/legg-til-service'><strong>Legg til service</strong></a>
				@else
					@foreach ($companyServices as $service)
						<p>Hovedfag: {{ $service->mainservice_id }} | Spesialisering: {{ $service->secondaryservice_id }}
						<p>Timepris: {{ $service->timepris }} </p>
						<p>Oppmøtepris: {{ $service->oppmøtepris }}</p>
						<p>
							<a href = '/no/selskap/oppdater-service/{{ $service->id }}'><strong>Rediger</strong></a>
							<a href = '/no/selskap/slett-service/{{ $service->id }}'><strong>Slett</strong></a>
						</p>
					@endforeach
					<a href = '/no/selskap/legg-til-service'><strong> + Legg til service</strong></a>
				@endif
			</div>
		@endif
			<h2>Forespørseler respondert på</h2>
			<h3>Kunder</h3>
			<table border = 1>
				@if($responseInfoToUsers == null)
					<p>Ingen forespørseler respondert på</p>
				@else
					<tr>
						<td>Hovedfag</td>
						<td>Spesialisering</td>
						<td>Postnummer</td>
						<td>Respons fra kunde</td>
					</tr>
					@foreach ($responseInfoToUsers as $responseInfoToUser)
						<tr>
							<td>{{ $responseInfoToUser->mainservice_id }}</td>
							<td>{{ $responseInfoToUser->secondaryservice_id }}</td>
							<td>{{ $responseInfoToUser->postnummer }}</td>
							@if($responseInfoToUser->akseptert == false)
								<td>Ikke akseptert</td>
							@else
								<td>Akseptert</td>
							@endif
						</tr>
					@endforeach
				@endif
			</table>

			<h3>Selskaper</h3>
			<table border = 1>
				@if($responseInfoToCompanies == null)
					<p>Ingen forespørseler respondert på</p>
				@else
					<tr>
						<td>Hovedkategori</td>
						<td>Underkategori</td>
						<td>Postnummer</td>
						<td>Respons fra kunde</td>
					</tr>
					@foreach ($responseInfoToCompanies as $responseInfoToCompanie)
						<tr>
							<td>{{ $responseInfoToCompanie->mainservice_id }}</td>
							<td>{{ $responseInfoToCompanie->secondaryservice_id }}</td>
							<td>{{ $responseInfoToCompanie->postnummer }}</td>
							@if($responseInfoToCompanie->akseptert == false)
								<td>Ikke akseptert</td>
							@else
								<td>Akseptert</td>
							@endif
						</tr>
					@endforeach
				@endif
			</table>

		<h2 name="myRequest">Mine behov</h2>
		@if($companyNeeds == null)
			<p>Ingen behov</p>
		@else
			<div class="users_box">
				@php ($IDCount = 1)
				@foreach ($companyNeeds as $need)
					<div class="infobox" style="border:1px solid black;">
						<p>
							<b>Hovedfag:</b> {{ $need->mainservice_id }}
							<b>Spesialisering:</b> {{ $need->secondaryservice_id }}
						</p>
						<p>{{ $need->oppsummering }}</p>
						<div class="workarea">
							<p>{{ $need->postnummer }}</p>
						</div>
						<p>
							@if($need->gyldig == false)
								<b>Ikke lenger gyldig</b>
							@else
								<a href= '/no/selskap/slett-hjelp/{{ $need->id }}'>Slett</a>
							@endif
						</p>
						<p><button id="{{ $IDCount }}" type="button" value="{{ $need->id }}" class="btn btn-warning moreInfoButtonCompany">Mer info</button></p>

						<div class="moreInfoCompany{{ $IDCount }}" style="display:none; border:1px solid black">
							<p class="resultTilgjengelig"></p>
							<p class="resultOppsummering"></p>
							<p class="resultBeskrivelse"></p>
						</div>
					</div>
					@php ($IDCount += 1)
				@endforeach
			</div>
		@endif

		<div id="responsesFromOtherWorkers">
			<h2>Responser fra andre fagfolk</h2>
			@if($responseInfoFromCompanies == null)
				<p>Ingen respons ennå</p>
			@else
				@php ($IDCount = 1)
				@foreach ($responseInfoFromCompanies as $response)
					<div class="responseFromWorker" style="border:1px solid black;">
						@if($response->ignorert != true)
							<p><b>Selskap:</b> {{ $response->selskap }}   <b>Org. nr:</b> {{ $response->org_nummer }}</p>
							<div class="workarea">
								<p>{{ $response->postnummer }}</p>
							</div>
							<p><b>Hovedfag:</b> {{ $response->mainservice_id }}   <b>Spesialisering:</b> {{ $response->secondaryservice_id }}</p>
							<p><b>Timepris:</b> {{ $response->timepris }}   <b>Oppmøtepris:</b> {{ $response->oppmøtepris }}</p>
							@if($response->gyldig == false)
								<p><b>Status: Ugyldig</b></p>
							@else
								<p>
									<a href= '/no/selskap/aksepter-respons-selskap/{{ $response->id }}/{{ $response->companyneed_id }}'>Aksepter | </a>
									<a href= '/no/selskap/ignorer-respons-selskap/{{ $response->id}}/{{ $response->companyneed_id}}'>Ignorer</a>
								</p>
							@endif
							<button id="{{ $IDCount }}" type="button" value="{{ $response->response_message }}" class="btn btn-warning msgFromWorker">Se melding fra selskap</button>
						@endif
						<div id="msgFromWorker{{ $IDCount }}" style="display:none;">
							<p id="tilgjengelig"></p>
							<p id="svarFraFagman"></p>
						</div>
					</div>
					@php ($IDCount += 1)
				@endforeach
			@endif
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="/js/moreInfoRequest.js"></script>
<script src="/js/getResponseMsg.js"></script>
@stop
