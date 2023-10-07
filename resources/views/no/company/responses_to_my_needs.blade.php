@extends('no.layouts.company_dashboard')
@section('title', 'Responser til mine behov')
@section('page_heading','Responser på mine behov')

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

	@if($responseInfoFromCompanies == null)
		<p>Ingen respons ennå</p>
	@else
		@php ($surveyCount = 0)
		@php ($visitedCount = 0)
		@php ($tmpCount1 = 0)
		@php ($rspCount = 0)
		@php ($oldRspID = 0)
		@php ($crntRspID = 0)

		@foreach ($responseInfoFromCompanies as $response)
			@php ($crntRspID = $response->companyneed_id)
			@if ($tmpCount1 < $visitedCount)
				@php ($tmpCount1 += 1)
				@continue
			@endif
			@if($response->befaring == true)
				@if ($crntRspID != $oldRspID && $response->gyldig != false)
					<h3>Befaring - {{$response->oppsummering}}</h3>
					@php ($oldRspID = $crntRspID)
				@endif
				@php ($surveyCount += 1)
				@if($response->antall_aksepterte_befaringer == 5)
					<div class="surveyBox inactive" >
				@else
					<div class="surveyBox" >
				@endif
				<p><b>Status: {{ $response->antall_aksepterte_befaringer }}/5 akseptert</b></p>
				@php ($tmpCount2 = 0)
				@foreach ($responseInfoFromCompanies as $response2)
					@if ($tmpCount2 < $visitedCount)
						@php ($tmpCount2 += 1)
						@continue
					@endif
					@if ($response->companyneed_id != $response2->companyneed_id)
						@break
					@else
						@php ($visitedCount += 1)
						@if($response->antall_aksepterte_befaringer == 5)
							<div class="responseFromWorker surveyBox infoBox inactive">
						@else
							<div class="responseFromWorker surveyBox infoBox">
						@endif
							@if($response2->ignorert != true)
								<p>
									<b>Selskap:</b> {{ $response2->selskap }}
									<b>Org. nr </b> {{ $response2->org_nummer }}
								</p>
								<p>
									<b>Hovedfag: </b> {{ $response2->mainservice_id }}  <b>Spesialisering: </b> {{ $response2->secondaryservice_id }}
								</p>
								<p>
									<b>Timepris:</b> {{ $response2->timepris }}   <b>Oppmøtepris:</b> {{ $response2->oppmøtepris }}
								</p>
								<p><b>Status: </b>
								@if($response2->akseptert == true)
									Akseptert</p>
								@else
									Venter respons</p>
								@endif
									@if($response2->gyldig != false && $response2->akseptert == false)
										<p>
											<a href= '/no/selskap/aksepter-respons-selskap/{{ $response2->id }}/{{ $response2->companyneed_id }}'>Aksepter | </a>
											<a href= '/no/selskap/ignorer-respons-selskap/{{ $response2->id}}/{{ $response2->companyneed_id}}'>Ignorer</a>
										</p>
									@endif
								<button id="{{ $visitedCount }}" type="button" value="{{ $response2->response_message }}" class="btn btn-info msgFromWorker">Se melding fra selskap</button>
							@endif
							<div id="msgFromWorker{{ $visitedCount }}" style="display:none;">
								<p id="tilgjengelig"></p>
								<p id="svarFraFagman"></p>
							</div>
							</div>
					@endif
					@php ($tmpCount2 += 1)
				@endforeach
			</div>
			@else
				@if ($crntRspID != $oldRspID && $response->gyldig != false)
					<h3>{{$response->oppsummering}}</h3>
					@php ($oldRspID = $crntRspID)
				@endif
				@php ($visitedCount += 1)
				@if($response->gyldig == false)
					<div class="singleBox inactive" >
						<p><b>Status: Ugyldig</b></p>
				@else
					<div class="singleBox" >
				@endif
				@if($response->gyldig == false)
					<div class="responseFromWorker singleBox infoBox inactive">
				@else
					<div class="responseFromWorker singleBox infoBox">
				@endif
				@if($response->ignorert == false)
					<p>
						<b>Selskap:</b> {{ $response->selskap }}
						<b>Org. nr </b> {{ $response->org_nummer }}
					</p>
					<p>
						<b>Hovedfag: </b> {{ $response->mainservice_id }}  <b>Spesialisering: </b> {{ $response->secondaryservice_id }}
					</p>
					<p>
						<b>Timepris:</b> {{ $response->timepris }}   <b>Oppmøtepris:</b> {{ $response->oppmøtepris }}
					</p>
					<p><b>Status:</b>
					@if($response->akseptert == true)
						Akseptert</p>
					@else
						Venter respons</p>
					@endif
					@if($response->gyldig != false)
						<p>
							<a href= '/no/selskap/aksepter-respons-selskap/{{ $response->companyneed_id }}/{{ $response->companyneed_id }}'>Aksepter | </a>
							<a href= '/no/selskap/ignorer-respons-selskap/{{ $response->companyneed_id}}/{{ $response->companyneed_id}}'>Ignorer</a>
						</p>
					@endif
					<button id="{{ $visitedCount }}" type="button" value="{{ $response->response_message }}" class="btn btn-info msgFromWorker">Se melding fra selskap</button>
				@endif
				<div id="msgFromWorker{{ $visitedCount }}" style="display:none;">
					<p id="tilgjengelig"></p>
					<p id="svarFraFagman"></p>
				</div>
			</div>
			</div>
			@endif
			@php ($tmpCount1 += 1)
		@endforeach
	@endif
@stop

@section('right-sidebar-content')
@stop

@section('scripts')
<script src="/js/getResponseMsg.js"></script>
@stop
