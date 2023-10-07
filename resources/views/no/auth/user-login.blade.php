@extends('no.layouts.master')
@section('title', 'Logg inn')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8-ds col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Logg inn som privat bruker</div>
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
                    <form class="form-horizontal" method="POST" action="{{ route('user.login.submit') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Passord</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4-ds">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Husk meg
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Logg inn
                                </button>

                                <a class="btn btn-link" href="{{ route('user.password.request') }}">
                                    Glemt passordet?
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
						<a href="{{ route('user.register') }}">Registrer deg som privatperson</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
