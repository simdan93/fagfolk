@extends('layouts.master')
@section('title', 'Registration of addresses')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Register addresses</div>
		<div class="panel-body">
			<form class="form-horizontal" method="POST" action="{{ route('user.register-addresses.submit') }}">
				{{ csrf_field() }}	
				
				<h2>Home address</h2>
				
				@if(session()->has('homeExists'))
					<div class="alert alert-success">
						{{ session()->get('homeExists') }}
					</div>
				@else
					<div class="form-group">
						<label for="address" class="col-md-4 control-label">Address</label>
		
						<div class="col-md-6">
							<input id="address" type="text" class="form-control" name="homeAddress" value="{{ old('address') }}" required autofocus>
		
							@if ($errors->has('address'))
								<span class="help-block">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('postNr') ? ' has-error' : '' }}">
						<label for="postNr" class="col-md-4 control-label">Post nr</label>
		
						<div class="col-md-6">
							<input id="postNr" type="text" class="form-control" name="homePostNr" value="{{ old('postNr') }}" required autofocus>
		
							@if ($errors->has('postNr'))
								<span class="help-block">
									<strong>{{ $errors->first('postNr') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
						<label for="phone" class="col-md-4 control-label">Location</label>
		
						<div class="col-md-6">
							<input id="location" type="location" class="form-control" name="homeLocation" value="{{ old('location') }}" required>
		
							@if ($errors->has('location'))
								<span class="help-block">
									<strong>{{ $errors->first('location') }}</strong>
								</span>
							@endif
						</div>
					</div>
				@endif
	
				<h2>Pay address</h2>
				
				@if(session()->has('payExists'))
					<div class="alert alert-success">
						{{ session()->get('payExists') }}
					</div>
				@else		
					<div class="form-group">
						<label for="address" class="col-md-4 control-label">Address</label>
		
						<div class="col-md-6">
							<input id="address" type="text" class="form-control" name="payAddress" value="{{ old('address') }}" required autofocus>
		
							@if ($errors->has('address'))
								<span class="help-block">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('postNr') ? ' has-error' : '' }}">
						<label for="postNr" class="col-md-4 control-label">Post nr</label>
		
						<div class="col-md-6">
							<input id="postNr" type="text" class="form-control" name="payPostNr" value="{{ old('postNr') }}" required autofocus>
		
							@if ($errors->has('postNr'))
								<span class="help-block">
									<strong>{{ $errors->first('postNr') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
						<label for="phone" class="col-md-4 control-label">Location</label>
		
						<div class="col-md-6">
							<input id="location" type="location" class="form-control" name="payLocation" value="{{ old('location') }}" required>
		
							@if ($errors->has('location'))
								<span class="help-block">
									<strong>{{ $errors->first('location') }}</strong>
								</span>
							@endif
						</div>
					</div>
		
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Register
							</button>
						</div>
					</div>
				@endif
			</form>
			<button onclick="location.href='{{ route('user.details') }}'">Avbryt</button>
		</div>
	</div>
</div>
@endsection
