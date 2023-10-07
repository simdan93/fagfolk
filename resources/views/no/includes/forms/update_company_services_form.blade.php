<div class="form-group">
	<label for="mainservice" class="col-md-4 control-label">Hovedfag</label>
	<div class="col-md-2">
		<select id="mainservice" name="mainservice" required>
			<option value='{{ $oldmainservice_id }}'>{{ $oldCompanyService[0]->mainservice_id }}</option>
			<option value='0'></option>
			@foreach($mainServices as $mainService)
				<option value='{{ $mainService->id }}'>{{ $mainService->hovedfag }}</option>
			@endforeach
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
	<div class="col-md-2">
		<select id="secondaryservice" name="secondaryservice" class="stdDropdownBox" required>
			<option value="{{ $oldsecondaryservice_id }}"> {{ $oldCompanyService[0]->secondaryservice_id }}</option>
			<option value=0>--</option>
			@foreach($restOfServices as $key=>$restOfService)
					<option value={{$restOfServicesIDs[$key]}}>{{ $restOfService->id }}</option>
			@endforeach
		</select>

		@if ($errors->has('secondaryservice'))
			<span class="help-block">
				<strong>{{ $errors->first('secondaryservice') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('timepris') ? ' has-error' : '' }}">
	<label for="timepris" class="col-md-4 control-label">Timepris</label>
	<div class="col-md-1">
		<input id="timepris" type="text" class="form-control" name="timepris" value="{{ $oldCompanyService[0]->timepris }}" required autofocus>

		@if ($errors->has('timepris'))
			<span class="help-block">
				<strong>{{ $errors->first('timepris') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('oppmøtepris') ? ' has-error' : '' }}">
	<label for="oppmøtepris" class="col-md-4 control-label">Oppmøtepris</label>
	<div class="col-md-1">
		<input id="oppmøtepris" type="text" class="form-control" name="oppmøtepris" value="{{$oldCompanyService[0]-> oppmøtepris }}" required autofocus>

		@if ($errors->has('oppmøtepris'))
			<span class="help-block">
				<strong>{{ $errors->first('oppmøtepris') }}</strong>
			</span>
		@endif
	</div>
</div>
