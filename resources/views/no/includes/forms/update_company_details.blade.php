<div class="form-group">
	<label for="selskap" class="col-md-5 control-label">Navnet til selskapet</label>
	<div class="col-md-5">
    <input type="text" class="form-control" name="selskap" value="{{ $companyDetails[0]->selskap }}" required autofocus>

		 @if ($errors->has('selskap'))
			<span class="help-block">
				<strong>{{ $errors->first('selskap') }}</strong>
			</span>
		@endif
  </div>
</div>

<div class="form-group">
	<label for="org_nummer" class="col-md-5 control-label">Org. nummer</label>
	<div class="col-md-5">
    <input type="text" class="form-control" name="org_nummer" value="{{ $companyDetails[0]->org_nummer }}" required autofocus>

		 @if ($errors->has('org_nummer'))
			<span class="help-block">
				<strong>{{ $errors->first('org_nummer') }}</strong>
			</span>
		@endif
  </div>
</div>
