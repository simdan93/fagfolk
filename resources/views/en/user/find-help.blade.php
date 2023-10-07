@extends('layouts.master')
@section('title', 'Find Help')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Find help</div>
	<div class="panel-body">
		<form class="form-horizontal" method="POST" action="{{ route('findHelp.submit') }}">
			{{ csrf_field() }}	
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
			
			<div class="form-group">
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
			
			<div class="form-group">
				<label for="location" class="col-md-4 control-label">Post number</label>
				<div class="col-md-6">
					<input id="postNr" type="postNr" class="" name="postNr" required>
					@if ($errors->has('postNr'))
						<span class="help-block">
							<strong>{{ $errors->first('postNr') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group">
				<label for="hourlyRate" class="col-md-4 control-label">Hourly Rate</label>
				<div class="col-md-6">
					<input id="hourlyRate" type="hourlyRate" class="" name="hourlyRate" required>
					@if ($errors->has('hourlyRate'))
						<span class="help-block">
							<strong>{{ $errors->first('hourlyRate') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group">
				<label for="attendanceRate" class="col-md-4 control-label">Attendance Rate</label>
				<div class="col-md-6">
					<input id="attendanceRate" type="attendanceRate" class="" name="attendanceRate" required>
					@if ($errors->has('attendanceRate'))
						<span class="help-block">
							<strong>{{ $errors->first('attendanceRate') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group">
				<label for="available" class="col-md-4 control-label">Available?</label>
				<div class="col-md-6">
					<select id="available" name="available">
						<option value='false'>Nei</option>
						<option value='true'>Ja</option>
					</select>							
					@if ($errors->has('available'))
						<span class="help-block">
							<strong>{{ $errors->first('available') }}</strong>
						</span>
					@endif
			</div>
			
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						Send request
					</button>
				</div>
			</div>
		</form>
		<button onclick="location.href='{{ route('user.dashboard') }}'">Go back</button>
	</div>
</div>
@stop

@section('scripts')
@stop