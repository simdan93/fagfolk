@if ($error = $errors->first('error_password_company'))
  <div class="alert alert-danger">
  {{ $error }}
  </div>
@endif
<div class="form-group">
    <label for="email" class="col-md-4 control-label">Email</label>
    <div class="col-md-6">
        <input id="emailCompany" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="password" class="col-md-4 control-label">Passord</label>
    <div class="col-md-6">
        <input id="passwordCompany" type="password" class="form-control" name="password" required>
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-4-ds">
        <a class="btn btn-link" href="{{ route('company.password.request') }}">
            Glemt passordet?
        </a>
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
  <a href="{{ route('company.register') }}">Registrer deg som selskap</a>
</div>
