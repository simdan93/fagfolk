@extends('no.layouts.master')
@section('title', 'Registration of companydetails')

@section('content')
<div class="bootstrap-iso">
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-heading">Fill in company details</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="{{ route('no.company.register.submit_details') }}">
					{{ csrf_field() }}
				
					<div class="form-group{{ $errors->has('companyName') ? ' has-error' : '' }}">
						<label for="companyName" class="col-md-4 control-label">CompanyName</label>
						<div class="col-md-6">
							<input id="companyName" type="text" class="form-control" name="companyName" value="{{ old('companyName') }}" required autofocus>
		
							@if ($errors->has('companyName'))
								<span class="help-block">
									<strong>{{ $errors->first('companyName') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group">
						<label for="orgNumber" class="col-md-4 control-label">Organization Number</label>
						<div class="col-md-6">
							<input id="orgNumber" type="text" class="form-control" name="orgNumber" value="{{ old('orgNumber') }}" required autofocus>
		
							@if ($errors->has('orgNumber'))
								<span class="help-block">
									<strong>{{ $errors->first('orgNumber') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('postNr') ? ' has-error' : '' }}">
						<label for="postNr" class="col-md-4 control-label">Post nr</label>
						<div class="col-md-6">
							<input id="postNr" type="text" class="form-control" name="postNr" value="{{ old('postNr') }}" required autofocus>

							@if ($errors->has('postNr'))
								<span class="help-block">
									<strong>{{ $errors->first('postNr') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group">
						<label for="professionMain" class="col-md-4 control-label">Main Profession</label>
						<div class="col-md-6">
							<select id="professionMain" name="professionMain">
								<?php $mainProfessions = array('Carpenter', 'Electrician', 'Plumber', 'Mechanic', 'Chief'); ?>
								@foreach($mainProfessions as $mainProfession)
									<option value='{{ $mainProfession }}'>{{ $mainProfession }}</option>
								@endforeach
							</select>
							
							@if ($errors->has('professionMain'))
								<span class="help-block">
									<strong>{{ $errors->first('professionMain') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('professionSpec') ? ' has-error' : '' }}">
						<label for="professionSpec" class="col-md-4 control-label">Specialization</label>
						<div class="col-md-6">
							<select id="professionSpec" name="professionSpec">
								<?php $specializations = array('Buildings', 'Furniture', 'Kitchen', 'Interior'); ?>
								@foreach($specializations as $specialization)
									<option value='{{ $specialization }}'>{{ $specialization }}</option>
								@endforeach
							</select>
							
							@if ($errors->has('professionSpec'))
								<span class="help-block">
									<strong>{{ $errors->first('professionSpec') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('hourlyRate') ? ' has-error' : '' }}">
						<label for="hourlyRate" class="col-md-4 control-label">Hourly rate</label>
						<div class="col-md-6">
							<input id="hourlyRate" type="text" class="form-control" name="hourlyRate" value="{{ old('hourlyRate') }}" required autofocus>
		
							@if ($errors->has('hourlyRate'))
								<span class="help-block">
									<strong>{{ $errors->first('hourlyRate') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('attendanceRate') ? ' has-error' : '' }}">
						<label for="attendanceRate" class="col-md-4 control-label">attendanceRate</label>
						<div class="col-md-6">
							<input id="attendanceRate" type="text" class="form-control" name="attendanceRate" value="{{ old('attendanceRate') }}" required autofocus>
		
							@if ($errors->has('attendanceRate'))
								<span class="help-block">
									<strong>{{ $errors->first('attendanceRate') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group">
						<label for="date" class="col-md-4 control-label">Available from</label>
						<div class="col-md-6">
							<input id="datepicker" type="text" class="form-control" name="availableFrom" value="{{ old('availableFrom') }}" required autofocus>									
							@if ($errors->has('availableFrom'))
								<span class="help-block">
									<strong>{{ $errors->first('availableFrom') }}</strong>
								</span>
							@endif
					</div>
				
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Register
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$( function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd/mm/yy"
		});
	} );
</script>
@stop