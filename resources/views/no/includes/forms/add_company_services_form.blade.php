<div class="form-group">
	<label for="mainservice2" class="col-md-4 control-label">Hovedfag</label>
	<div class="col-md-2">
		<select id="mainservice2" name="mainservice2" required>
			<option value='0'></option>
			@foreach($mainServices as $mainService)
				<option value='{{ $mainService->id }}'>{{ $mainService->hovedfag }}</option>
			@endforeach
		</select>

		@if ($errors->has('mainservice2'))
			<span class="help-block">
				<strong>{{ $errors->first('mainservice2') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group">
	<label for="secondaryservice2" class="col-md-4 control-label">Spesialisering</label>
	<div class="col-md-2">
		<select id="secondaryservice2" name="secondaryservice2" class="" required>
		</select>

		@if ($errors->has('secondaryservice2'))
			<span class="help-block">
				<strong>{{ $errors->first('secondaryservice2') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('timepris') ? ' has-error' : '' }}">
	<label for="timepris" class="col-md-4 control-label">Timepris</label>
	<div class="col-md-1">
		<input id="timepris" type="text" class="form-control" name="timepris" value="{{ old('timepris') }}" required autofocus>

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
		<input id="oppmøtepris" type="text" class="form-control" name="oppmøtepris" value="{{ old('oppmøtepris') }}" required autofocus>

		@if ($errors->has('oppmøtepris'))
			<span class="help-block">
				<strong>{{ $errors->first('oppmøtepris') }}</strong>
			</span>
		@endif
	</div>
</div>
<!--
<div class="form-group{{ $errors->has('tilgjengelig') ? ' has-error' : '' }}">
	<label for="tilgjengelig" class="col-md-4 control-label">Tilgjengelighetsstatus</label>
	<div class="col-md-4">
		<input id="datepicker" type="text" class="form-control" name="tilgjengelig" value="{{ old('tilgjengelig') }}" required autofocus>

		@if ($errors->has('tilgjengelig'))
			<span class="help-block">
				<strong>{{ $errors->first('tilgjengelig') }}</strong>
			</span>
		@endif
	</div>
</div>
-->
