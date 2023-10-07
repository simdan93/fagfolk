@extends('no.layouts.user_dashboard')
@section('title', 'Finn hjelp')
@section('page_heading','Finn hjelp')

@section('dashboard-content')
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="findHelpBox">
		<form class="form-horizontal" method="POST" action="{{ route('findHelp.submit') }}">
			{{ csrf_field() }}

			<div class="form-group">
				<label for="mainservice" class="col-md-4 control-label">Hovedfag</label>
				<div class="col-md-5">
					<select id="mainservice" name="mainservice" class="stdDropdownBox" required>
						@if(isset($secServices_from_arg) && isset($secServices_from_arg_conv))
							<option value='{{ $secServices_from_arg[0]->mainservice_id }}'>{{ $secServices_from_arg_conv[0]->mainservice_id }}</option>
						@elseif(isset($mainService))
							<option value='{{ $mainService[0]->id }}'>{{ $mainService[0]->hovedfag }}</option>
						@else
							<option value='0'></option>
						@endif
						@if (!isset($mainService))
							@foreach($mainServices as $mainservice)
								@if(isset($secServices_from_arg_conv))
									@if($mainservice->hovedfag != $secServices_from_arg_conv[0]->mainservice_id)
										<option value='{{ $mainservice->id }}'>{{ $mainservice->hovedfag }}</option>
									@endif
								@else
									<option value='{{ $mainservice->id }}'>{{ $mainservice->hovedfag }}</option>
								@endif
							@endforeach
						@else
							@foreach($mainServices as $mainservice)
								@if($mainservice->id != $mainServices[0]->id)
										<option value='{{ $mainservice->id }}'>{{ $mainservice->hovedfag }}</option>
								@endif
							@endforeach
						@endif
					</select>

					@if ($errors->has('mainservice'))
						<span class="help-block">
							<strong>{{ $errors->first('mainservice') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label for="secondaryservice" class="col-md-4 control-label">Spesialisering</label>
				<div class="col-md-5">
					<select id="secondaryservice" name="secondaryservice" class="stdDropdownBox" required>
						@if (!isset($mainService))
							@if(isset($secServices_from_arg) && isset($secServices_from_arg_conv))
								<option value='{{ $secServices_from_arg[0]->id }}'>{{ $secServices_from_arg_conv[0]->spesialisering }}</option>
								@foreach($secServices_pre_ajax as $secService_pre_ajax)
									@if($secService_pre_ajax->spesialisering != $secServices_from_arg_conv[0]->spesialisering)
										<option value='{{ $secService_pre_ajax->id }}'>{{ $secService_pre_ajax->spesialisering }}</option>
									@endif
								@endforeach
							@endif
						@else
							<option value='0'>--</option>
						@endif
					</select>

					@if ($errors->has('secondaryservice'))
						<span class="help-block">
							<strong>{{ $errors->first('secondaryservice') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label for="oppsummering" class="col-md-4 control-label">Oppsummering</label>
				<div class="col-md-5">
					<textarea name="oppsummering" rows="1" cols="40" required></textarea>
					@if ($errors->has('oppsummering'))
						<span class="help-block">
							<strong>{{ $errors->first('oppsummering') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label for="beskrivelse" class="col-md-4 control-label">Beskrivelse</label>
				<div class="col-md-5">
					<textarea name="beskrivelse" rows="8", cols="40"></textarea>
					@if ($errors->has('beskrivelse'))
						<span class="help-block">
							<strong>{{ $errors->first('beskrivelse') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label for="postnummer" class="col-md-4 control-label">Adresse</label>
				<div class="col-md-4">
					@if($homeAdress == null && $payAdress == null)
						<a href="{{ route('user.register-addresses') }}">Registrer addresser</a>
					@else
						<select id="postnummer" name="postnummer" class="form-control" required>
								<option value='{{ $homeAdress[0]->postnummer }}'>{{ $homeAdress[0]->addresse }}</option>
								@if($payAdress[0]->faktura_addresse != $homeAdress[0]->addresse)
									<option value='{{ $payAdress[0]->faktura_postnummer }}'>{{ $payAdress[0]->faktura_addresse }}</option>
								@endif
						</select>
					@endif
					@if ($errors->has('postnummer'))
						<span class="help-block">
							<strong>{{ $errors->first('postnummer') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label for="tilgjengelig" class="col-md-4 control-label">Dato ønsket</label>
				<div class="col-md-1">
					<input id="tilgjengelig" type="tilgjengelig" class="form-control" name="tilgjengelig" required>
					@if ($errors->has('tilgjengelig'))
						<span class="help-block">
							<strong>{{ $errors->first('tilgjengelig') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4-ds">
					<button id="checkInfo" type="button" class="btn btn-warning">
						Sjekk sannsynlighet
					</button>
				</div>
			</div>
			<div class="col-md-offset-4-ds" style="padding-bottom:10px;">
				<p id="result"></p>
				<p id="counter"></p>
			</div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4-ds">
					<button type="submit" class="btn btn-primary submitbtn" name="seekingOne">
						Bestill timebetalt
					</button>
					<button type="submit" class="btn btn-primary submitbtn" name="seekingMultiple">
						Bestill befaring
					</button>
				</div>
			</div>
			<div class="col-md-offset-4-ds">
				<button onclick="location.href='{{ route('user.dashboard') }}'">Avbryt</button>
				</div>
		</form>
	</div>
@stop

@section('right-sidebar-content')
@stop

@section('scripts')
<script src="/js/user/checkAvailability.js"></script>
<script src="/js/user/checkSecondaryServices.js"></script>
<script src="/js/user/seekingSurvey.js"></script>
<script>
	// A datepicker we can place at the form
	$( function() {
		$( "#tilgjengelig" ).datepicker( {
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd-mm-yy"
		});
	} );
</script>
@stop
