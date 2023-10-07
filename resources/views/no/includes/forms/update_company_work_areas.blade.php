<div class="form-group">
	<label for="postnummer" class="col-md-4 control-label">Postnummer</label>
	<div class="col-md-4">
		@php($key = 0)
		@foreach ($companyWorkAreas as $key => $oldCompanyWorkArea)
		<input type="text" class="form-control" name="work_areas[]" value="{{ $oldCompanyWorkArea->postnummer }}" autofocus>
		@endforeach
		@for($i=$key+1; $i<($key+10); $i++)
			<input type="text" class="form-control" name="work_areas[]">
		@endfor

		@if ($errors->has('postnummer'))
			<span class="help-block">
				<strong>{{ $errors->first('postnummer') }}</strong>
			</span>
		@endif
	</div>
</div>
