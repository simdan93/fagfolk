@extends('no.layouts.user_dashboard')
@section('title', 'Oppdatere addressne')
@section('page_heading','Oppdatere addressene')

@section('dashboard-content')
<form class="form-horizontal" method="POST" action="/no/bruker/mine-detaljer/oppdater-addresser">
	{{ csrf_field() }}
	<h2>Hjem</h2>
	<div class="form-group">
		<label for="addresse" class="col-md-1 control-label">Addresse</label>

		<div class="col-md-4">
			<input id="addresse" type="text" class="form-control" name="addresse" value="{{$homeAddress[0]->addresse}}" required autofocus>

			@if ($errors->has('addresse'))
				<span class="help-block">
					<strong>{{ $errors->first('addresse') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('postnummer') ? ' has-error' : '' }}">
		<label for="postnummer" class="col-md-1 control-label">Postnr</label>

		<div class="col-md-1">
			<input id="postnummer" type="text" class="form-control" name="postnummer" value="{{$homeAddress[0]->postnummer}}" required autofocus>

			@if ($errors->has('postnummer'))
				<span class="help-block">
					<strong>{{ $errors->first('postnummer') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('sted') ? ' has-error' : '' }}">
		<label for="sted" class="col-md-1 control-label">By</label>

		<div class="col-md-4">
			<input id="sted" type="text" class="form-control" name="sted" value="{{$homeAddress[0]->sted}}" required>

			@if ($errors->has('sted'))
				<span class="help-block">
					<strong>{{ $errors->first('sted') }}</strong>
				</span>
			@endif
		</div>
	</div>

<div class="form-group">
  <label for="sted" class="col-md-1 control-label"></label>
  <div class="col-md-6">
  	<input type="checkbox" onclick="fillBilling(this.form)" name="billingBox">
    <em>Trykk her hvis faktura-addressen er det samme som hjemmeaddressen.</em>
  </div>
</div>
	<h2>Faktura</h2>
	<div class="form-group">
		<label for="faktura_addresse" class="col-md-1 control-label">Addresse</label>

		<div class="col-md-4">
			<input id="faktura_addresse" type="text" class="form-control" name="faktura_addresse" value="{{$payAddress[0]->faktura_addresse}}" required autofocus>

			@if ($errors->has('faktura_addresse'))
				<span class="help-block">
					<strong>{{ $errors->first('faktura_addresse') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('faktura_postnummer') ? ' has-error' : '' }}">
		<label for="faktura_postnummer" class="col-md-1 control-label">Postnr</label>

		<div class="col-md-1">
			<input id="faktura_postnummer" type="text" class="form-control" name="faktura_postnummer" value="{{$payAddress[0]->faktura_postnummer}}" required autofocus>

			@if ($errors->has('faktura_postnummer'))
				<span class="help-block">
					<strong>{{ $errors->first('faktura_postnummer') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('faktura_by') ? ' has-error' : '' }}">
		<label for="faktura_by" class="col-md-1 control-label">By</label>

		<div class="col-md-4">
			<input id="faktura_by" type="text" class="form-control" name="faktura_by" value="{{$payAddress[0]->faktura_by}}" required>

			@if ($errors->has('faktura_by'))
				<span class="help-block">
					<strong>{{ $errors->first('faktura_by') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-1 col-md-offset-1">
			<button type="submit" class="btn btn-primary">
				Oppdater
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
