@extends('no.layouts.master')
@section('title', 'Registrer bruker')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Registrering av privatperson</div>
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
                    <form class="form-horizontal" method="POST" action="{{ route('user.register.submit') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="navn" class="col-md-4 control-label">Fornavn</label>

                            <div class="col-md-5">
                                <input id="navn" type="text" class="form-control" name="navn" value="{{ old('navn') }}" required autofocus>

                                @if ($errors->has('navn'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('navn') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

            						<div class="form-group">
            							<label for="etternavn" class="col-md-4 control-label">Etternavn</label>

            							<div class="col-md-5">
            								<input id="etternavn" type="text" class="form-control" name="etternavn" value="{{ old('etternavn') }}" required autofocus>

            								@if ($errors->has('etternavn'))
            									<span class="help-block">
            										<strong>{{ $errors->first('etternavn') }}</strong>
            									</span>
            								@endif
            							</div>
            						</div>

            						<div class="form-group">
            							<label for="age" class="col-md-4 control-label">Alder (valgfritt)</label>

            							<div class="col-md-4">
            								<select id="alder" name="alder" class="form-control" >
            									<option value="{{ old('alder') }}">{{ old('alder') }}</option>
            									<?php $minBirth= date('Y')-16; ?>
            									@for ($i = 1950; $i <= $minBirth; $i++)
            										<option value="{{ $i }}">{{ $i }}</option>
            									@endfor
            								</select>

            								@if ($errors->has('alder'))
            									<span class="help-block">
            										<strong>{{ $errors->first('alder') }}</strong>
            									</span>
            								@endif
            							</div>
            						</div>

            						<div class="form-group">
                            <label for="telefon" class="col-md-4 control-label">Telefon (valgfritt)</label>

                            <div class="col-md-5">
                                <input id="telefon" type="telefon" class="form-control" name="telefon" value="{{ old('telefon') }}">

                                @if ($errors->has('telefon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

		                    <div class="form-group">
                          <label for="mobil" class="col-md-4 control-label">Mobil</label>

                            <div class="col-md-5">
                                <input id="mobil" type="mobil" class="form-control" name="mobil" value="{{ old('mobil') }}" required>

                                @if ($errors->has('mobil'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-5">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Passord</label>

                            <div class="col-md-5">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Minimum 6 sifre" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Gjenta passordet</label>

                            <div class="col-md-5">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
