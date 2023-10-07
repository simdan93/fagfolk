@extends('no.layouts.master')
@section('title', 'Registrering av servicer')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
							<div class="panel-heading">Registrering av service</div>
							<div class="panel-body">
								<form class="form-horizontal" method="POST" action="{{ url('/no/selskap/registrer-service') }}">
									{{ csrf_field() }}
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

									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Fullfør registrering
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
@stop

@section('scripts')
<script src="/js/company/checkSecondaryServices.js"></script>
<script src="/js/company/checkSecondaryServices2.js"></script>
@stop
