@extends('no.layouts.company_dashboard')
@section('title', 'Mine services')
@section('page_heading','Mine services')
@section('dashboard-content')
		@if(session()->has('serviceAdded'))
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
		@endif
		@foreach ($oldCompanyService as $service)
			<div class="standardBox" style="padding: 5px;">
				<p><b>Hovedfag: </b>{{ $service->mainservice_id }} | <b>Spesialisering: </b>{{ $service->secondaryservice_id }}
				<p><b>Timepris: </b>{{ $service->timepris }} </p>
				<p><b>Oppmøtepris: </b>{{ $service->oppmøtepris }}</p>
				<p>
					<!--<a href = '/no/selskap/oppdater-service/{{ $service->id }}'><strong>Rediger</strong></a>-->
					<a href = '#' data-toggle="modal" data-target="#serviceModal"><strong>Rediger</strong></a>
					<a href = '/no/selskap/slett-service/{{ $service->id }}'><strong>Slett</strong></a>
				</p>
			</div>
		@endforeach
		<a href = '#' data-toggle="modal" data-target="#serviceModalAddService"><strong> + Legg til service</strong></a>

		<!-- Modal -->
		<div class="modal fade" id="serviceModal">
			<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" action="/no/selskap/oppdater-service/{{ $oldCompanyService[0]->id }}">
							{{ csrf_field() }}
							<div class="modal-header">
									<h3 class="modal-title">Endre service</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
									</button>
							</div>
							<div class="modal-body">
									@include('no.includes.forms.update_company_services_form')
							</div>
							<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
									<button type="submit" class="btn btn-primary">Lagre endringer</button>
							</div>
						</form>
					</div>
			</div>
		</div>

		<!-- Modal-Add-Service -->
		<div class="modal fade" id="serviceModalAddService">
			<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" action="{{ route('company.submit.add-services') }}">
							{{ csrf_field() }}
							<div class="modal-header">
									<h3 class="modal-title">Legg til service</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
									</button>
							</div>
							<div class="modal-body">
									@include('no.includes.forms.add_company_services_form')
							</div>
							<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
									<button type="submit" class="btn btn-primary">Legg til</button>
							</div>
						</form>
					</div>
			</div>
		</div>
@stop

@section('right-sidebar-content')
@stop

@section('scripts')
<script src="/js/company/moreInfoRequest.js"></script>
<script src="/js/company/checkSecondaryServices.js"></script>
<script src="/js/company/checkSecondaryServices2.js"></script>
@stop
