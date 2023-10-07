<h4>Kontoret</h4>
<div class="form-group">
	<label for="kontor_addresse" class="col-md-2 control-label">Addresse</label>

	<div class="col-md-5">
		<input id="kontor_addresse" type="text" class="form-control" name="kontor_addresse" value="{{$officeAdress[0]->kontor_addresse}}" required autofocus>

		@if ($errors->has('kontor_addresse'))
			<span class="help-block">
				<strong>{{ $errors->first('kontor_addresse') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('kontor_postnummer') ? ' has-error' : '' }}">
	<label for="kontor_postnummer" class="col-md-2 control-label">Postnr</label>

	<div class="col-md-2">
		<input id="kontor_postnummer" type="text" class="form-control" name="kontor_postnummer" value="{{$officeAdress[0]->kontor_postnummer}}" required autofocus>

		@if ($errors->has('kontor_postnummer'))
			<span class="help-block">
				<strong>{{ $errors->first('kontor_postnummer') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('kontor_by') ? ' has-error' : '' }}">
	<label for="kontor_by" class="col-md-2 control-label">By</label>

	<div class="col-md-5">
		<input id="kontor_by" type="text" class="form-control" name="kontor_by" value="{{$officeAdress[0]->kontor_by}}" required>

		@if ($errors->has('kontor_by'))
			<span class="help-block">
				<strong>{{ $errors->first('kontor_by') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group">
<label for="sted" class="col-md-2 control-label"></label>
<div class="col-md-6">
	<input type="checkbox" onclick="fillBillingCompany(this.form)" name="billingBox">
	<em>Trykk her hvis faktura-addressen er det samme som hjemmeaddressen.</em>
</div>
</div>
<h4>Faktura</h4>
<div class="form-group">
	<label for="faktura_addresse" class="col-md-2 control-label">Addresse</label>

	<div class="col-md-5">
		<input id="faktura_addresse" type="text" class="form-control" name="faktura_addresse" value="{{$payAdress[0]->faktura_addresse}}" required autofocus>

		@if ($errors->has('faktura_addresse'))
			<span class="help-block">
				<strong>{{ $errors->first('faktura_addresse') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('faktura_postnummer') ? ' has-error' : '' }}">
	<label for="faktura_postnummer" class="col-md-2 control-label">Postnr</label>

	<div class="col-md-2">
		<input id="faktura_postnummer" type="text" class="form-control" name="faktura_postnummer" value="{{$payAdress[0]->faktura_postnummer}}" required autofocus>

		@if ($errors->has('faktura_postnummer'))
			<span class="help-block">
				<strong>{{ $errors->first('faktura_postnummer') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('faktura_by') ? ' has-error' : '' }}">
	<label for="faktura_by" class="col-md-2 control-label">By</label>

	<div class="col-md-5">
		<input id="faktura_by" type="text" class="form-control" name="faktura_by" value="{{$payAdress[0]->faktura_by}}" required>

		@if ($errors->has('faktura_by'))
			<span class="help-block">
				<strong>{{ $errors->first('faktura_by') }}</strong>
			</span>
		@endif
	</div>
</div>
