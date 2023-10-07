@extends('layouts.master')
@section('title', 'Registration of new user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register USER</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('user.register.submit') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
						<div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
							<label for="lastName" class="col-md-4 control-label">Last name</label>
	
							<div class="col-md-6">
								<input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>
	
								@if ($errors->has('lastName'))
									<span class="help-block">
										<strong>{{ $errors->first('lastName') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="age" class="col-md-4 control-label">Age (optional)</label>
	
							<div class="col-md-6">
								<select id="age" name="age" class="form-control" >
									<option value="{{ old('age') }}">{{ old('age') }}</option>									
									<?php $minBirth= date('Y')-16; ?>
									@for ($i = 1950; $i <= $minBirth; $i++)
										<option value="{{ $i }}">{{ $i }}</option>
									@endfor
								</select>
	
								@if ($errors->has('age'))
									<span class="help-block">
										<strong>{{ $errors->first('age') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone (optional)</label>

                            <div class="col-md-6">
                                <input id="cell" type="phone" class="form-control" name="phone" value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
						<div class="form-group{{ $errors->has('cell') ? ' has-error' : '' }}">
                            <label for="cell" class="col-md-4 control-label">Cell</label>

                            <div class="col-md-6">
                                <input id="cell" type="cell" class="form-control" name="cell" value="{{ old('cell') }}" required>

                                @if ($errors->has('cell'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cell') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
						
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                           </div>
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
</div>
@endsection
