@extends('no.layouts.user_dashboard')
@section('title', 'Registrering av addresser')
@section('page_heading','Registrering av addresser')

@section('dashboard-content')
	<form class="form-horizontal" method="POST" action="{{ route('user.register-addresses.submit') }}">
		{{ csrf_field() }}
		<h2>Hjemmeaddresse</h2>
		<div class="form-group">
			<label for="addresse" class="col-md-4 control-label">Addresse</label>

			<div class="col-md-6">
				<input id="addresse" type="text" class="form-control" name="addresse" value="{{ old('addresse') }}" required autofocus>

				@if ($errors->has('addresse'))
					<span class="help-block">
						<strong>{{ $errors->first('addresse') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('postnummer') ? ' has-error' : '' }}">
			<label for="postnummer" class="col-md-4 control-label">Postnummer</label>

			<div class="col-md-6">
				<input id="postnummer" type="text" class="form-control" name="postnummer" value="{{ old('postnummer') }}" required autofocus>

				@if ($errors->has('postnummer'))
					<span class="help-block">
						<strong>{{ $errors->first('postnummer') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('sted') ? ' has-error' : '' }}">
			<label for="phone" class="col-md-4 control-label">By</label>

			<div class="col-md-6">
				<input id="sted" type="text" class="form-control" name="sted" value="{{ old('sted') }}" required>

				@if ($errors->has('sted'))
					<span class="help-block">
						<strong>{{ $errors->first('sted') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<input type="checkbox" onclick="fillBilling(this.form)" name="billingBox">
		<em>Trykk her hvis faktura-addressen er det samme som hjemmeaddressen.</em>

		<h2>Faktura addresse</h2>
		<div class="form-group">
			<label for="faktura_addresse" class="col-md-4 control-label">Addresse</label>

			<div class="col-md-6">
				<input id="faktura_addresse" type="text" class="form-control" name="faktura_addresse" value="{{ old('faktura_addresse') }}" required autofocus>

				@if ($errors->has('faktura_addresse'))
					<span class="help-block">
						<strong>{{ $errors->first('faktura_addresse') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('faktura_postnummer') ? ' has-error' : '' }}">
			<label for="faktura_postnummer" class="col-md-4 control-label">Postnummer</label>

			<div class="col-md-6">
				<input id="faktura_postnummer" type="text" class="form-control" name="faktura_postnummer" value="{{ old('faktura_postnummer') }}" required autofocus>

				@if ($errors->has('faktura_postnummer'))
					<span class="help-block">
						<strong>{{ $errors->first('faktura_postnummer') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('faktura_by') ? ' has-error' : '' }}">
			<label for="faktura_by" class="col-md-4 control-label">By</label>

			<div class="col-md-6">
				<input id="faktura_by" type="text" class="form-control" name="faktura_by" value="{{ old('faktura_by') }}" required>

				@if ($errors->has('faktura_by'))
					<span class="help-block">
						<strong>{{ $errors->first('faktura_by') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
					Registrer
				</button>
			</div>
		</div>
	</form>
	<button onclick="location.href='{{ route('user.details') }}'">Avbryt</button>
@endsection

@section('right-sidebar-content')
@stop

@section('scripts')
<script>
	//Check checkbox if filled, if filled copy the home address to pay address fields
	function fillBilling(f)
	{
		if(f.billingBox.checked == true)
		{
			f.faktura_addresse.value = f.addresse.value;
			f.faktura_postnummer.value = f.postnummer.value;
			f.faktura_by.value = f.sted.value;
		}
	}
</script>
@stop
