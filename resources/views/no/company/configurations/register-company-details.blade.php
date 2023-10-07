@extends('no.layouts.master')
@section('title', 'Registrering av selskapinformasjon')
@section('page_heading','Registrering av selskapinformasjon')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrering av selskapinformasjon</div>
                <div class="panel-body">
									<form class="form-horizontal" method="POST" action="{{ route('company.register.submit_details') }}">
										{{ csrf_field() }}

										<div class="form-group{{ $errors->has('selskap') ? ' has-error' : '' }}">
											<label for="selskap" class="col-md-4 control-label">Navnet til selskapet</label>
											<div class="col-md-6">
												<input id="selskap" type="text" class="form-control" name="selskap" value="{{ old('selskap') }}" required autofocus>

												@if ($errors->has('selskap'))
													<span class="help-block">
														<strong>{{ $errors->first('selskap') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<div class="form-group">
											<label for="org_nummer" class="col-md-4 control-label">Org. nummer</label>
											<div class="col-md-6">
												<input id="org_nummer" type="text" class="form-control" name="org_nummer" value="{{ old('org_nummer') }}" required autofocus>

												@if ($errors->has('org_nummer'))
													<span class="help-block">
														<strong>{{ $errors->first('org_nummer') }}</strong>
													</span>
												@endif
											</div>
										</div>
<!--
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
-->
										<div class="form-group">
											<div class="col-md-6 col-md-offset-4">
												<button type="submit" class="btn btn-primary">
													Registrer
												</button>
											</div>
										</div>

									</form>
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button onclick="location.href='{{ route('company.dashboard') }}'">Avbryt - Ta meg tilbake</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection

@section('scripts')
@stop
