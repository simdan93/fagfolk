<div class="form-group">
	<label for="navn" class="col-md-3 control-label">Fornavn</label>
	<div class="col-md-3">
    <input type="text" class="form-control" name="navn" value="{{ $userDetails[0]->navn }}" required >

		 @if ($errors->has('navn'))
			<span class="help-block">
				<strong>{{ $errors->first('navn') }}</strong>
			</span>
		@endif
  </div>
</div>

<div class="form-group">
	<label for="etternavn" class="col-md-3 control-label">Etternavn</label>
	<div class="col-md-3">
    <input type="text" class="form-control" name="etternavn" value="{{ $userDetails[0]->etternavn }}" required>

		 @if ($errors->has('etternavn'))
			<span class="help-block">
				<strong>{{ $errors->first('etternavn') }}</strong>
			</span>
		@endif
  </div>
</div>

<div class="form-group">
	<label for="alder" class="col-md-3 control-label">Alder</label>
	<div class="col-md-3">
		<select id="alder" name="alder" class="form-control" >
			<option value="{{ $userDetails[0]->alder }}">{{ $userDetails[0]->alder }}</option>
			<?php $minBirth= date('Y')-16; ?>
			@for ($i = (date('Y') - 90); $i <= $minBirth; $i++)
				<option value="{{ $i }}">{{ $i }}</option>
			@endfor
		</select>
		 @if ($errors->has('alder'))
			<span class="help-block">
				<strong>{{ $errors->first('alder') }}</strong>
			</span>
		@endif
  </div>
</div>

<div class="form-group">
	<label for="telefon" class="col-md-3 control-label">Telefon</label>
	<div class="col-md-3">
    <input type="text" class="form-control" name="telefon" value="{{ $userDetails[0]->telefon }}" >

		 @if ($errors->has('telefon'))
			<span class="help-block">
				<strong>{{ $errors->first('telefon') }}</strong>
			</span>
		@endif
  </div>
</div>

<div class="form-group">
	<label for="mobil" class="col-md-3 control-label">Mobil</label>
	<div class="col-md-3">
    <input type="text" class="form-control" name="mobil" value="{{ $userDetails[0]->mobil }}" required >

		 @if ($errors->has('mobil'))
			<span class="help-block">
				<strong>{{ $errors->first('mobil') }}</strong>
			</span>
		@endif
  </div>
</div>
