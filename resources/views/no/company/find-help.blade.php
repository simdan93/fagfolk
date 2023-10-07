@extends('no.layouts.company_dashboard')
@section('title', 'Finn fagfolk')
@section('page_heading','Finn andre fagfolk')

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
		<form class="form-horizontal" method="POST" action="{{ route('findHelpCompany.submit') }}">
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
					<textarea name="oppsummering" rows="1", cols="40" required></textarea>
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
				<label for="postnummer" class="col-md-4 control-label">Addresse</label>
				<div class="col-md-4">
					<select id="postnummer" name="postnummer" class="form-control">
							<option value='{{ $officeAdress[0]->kontor_postnummer }}'>{{ $officeAdress[0]->kontor_addresse }}</option>
							@if($payAdress[0]->faktura_postnummer != $officeAdress[0]->kontor_postnummer)
								<option value='{{ $payAdress[0]->faktura_postnummer }}'>{{ $payAdress[0]->faktura_addresse }}</option>
							@endif
					</select>
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
					<input id="tilgjengelig" type="text" class="form-control" name="tilgjengelig" required>
					@if ($errors->has('tilgjengelig'))
						<span class="help-block">
							<strong>{{ $errors->first('tilgjengelig') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-5 col-md-offset-4-ds">
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
						Bestil befaring
					</button>
				</div>
			</div>
		</form>
		<div class="col-md-offset-4-ds">
			<button onclick="location.href='{{ route('company.dashboard') }}'" type="button">Avbryt</button>
		</div>
	</div>
@stop

@section('right-sidebar-content')
<p>Hovedfag lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices nisl vel commodo luctus. Curabitur blandit magna vel ipsum commodo, vestibulum vestibulum purus facilisis.
</p>
<br>
<p>
Spesialisering pellentesque dictum ligula sit amet libero vulputate dictum. Nam eget dui laoreet, mollis risus ac, tincidunt leo. Donec varius diam et facilisis ullamcorper.
</p><br>
<p>
Oppsummering nam cursus felis non imperdiet fermentum. Ut tempus imperdiet enim vitae feugiat.
</p><br>
<p>
Adresse aecenas non pretium velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
</p><br>
<p>
Dato ønsket morbi sollicitudin varius lorem, vitae blandit ante rhoncus vehicula. Cras tincidunt, diam a finibus fringilla, magna felis dapibus massa, non suscipit dui sem a diam.
</p>
@stop

@section('scripts')
<script src="/js/company/checkSecondaryServices.js"></script>
<script src="/js/company/checkAvailability.js"></script>
<script src="/js/user/seekingSurvey.js"></script>
<script>
	$( function() {
		$( "#tilgjengelig" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd-mm-yy"
		});
	} );
</script>
@stop
