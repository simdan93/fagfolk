@extends('no.layouts.master')
@section('title', 'Registrering av addresser')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrering av addresser</div>
                <div class="panel-body">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
									<form class="form-horizontal" method="POST" action="{{ route('company.register-addresses.submit') }}">
										{{ csrf_field() }}
										<h2>Kontoraddresse</h2>
										<div class="form-group">
											<label for="kontor_addresse" class="col-md-4 control-label">Addresse</label>

											<div class="col-md-6">
												<input id="kontor_addresse" type="text" class="form-control" name="kontor_addresse" value="{{ old('kontor_addresse') }}" required autofocus>

												@if ($errors->has('kontor_addresse'))
													<span class="help-block">
														<strong>{{ $errors->first('kontor_addresse') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<div class="form-group{{ $errors->has('kontor_postnummer') ? ' has-error' : '' }}">
											<label for="kontor_postnummer" class="col-md-4 control-label">Postnummer</label>

											<div class="col-md-6">
												<input id="kontor_postnummer" type="text" class="form-control" name="kontor_postnummer" value="{{ old('kontor_postnummer') }}" required autofocus>

												@if ($errors->has('kontor_postnummer'))
													<span class="help-block">
														<strong>{{ $errors->first('kontor_postnummer') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<div class="form-group{{ $errors->has('kontor_by') ? ' has-error' : '' }}">
											<label for="kontor_by" class="col-md-4 control-label">By</label>

											<div class="col-md-6">
												<input id="kontor_by" type="text" class="form-control" name="kontor_by" value="{{ old('kontor_by') }}" required>

												@if ($errors->has('kontor_by'))
													<span class="help-block">
														<strong>{{ $errors->first('kontor_by') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<input type="checkbox" onclick="fillBillingCompany(this.form)" name="billingBox">
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
									<button onclick="location.href='{{ route('welcome') }}'">Avbryt</button>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection

@section('scripts')
<script>
	//Check checkbox if filled, if filled copy the home address to pay address fields
	function fillBillingCompany(f)
	{
		if(f.billingBox.checked == true)
		{
			f.faktura_addresse.value = f.kontor_addresse.value;
			f.faktura_postnummer.value = f.kontor_postnummer.value;
			f.faktura_by.value = f.kontor_by.value;
		}
	}
</script>
@stop
