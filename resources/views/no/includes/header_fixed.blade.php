<nav class="navbar-fixed navbar-default navbar-static-top .navbar-top-placement" role="navigation" style="margin-bottom: 0">
	<div class="navbar-top-links-box">
		<div class = "navbar-header">
			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}" style="padding: 5px">
				<img src="images/Logoer/Fagfolk.grear_.big_-300x63.png">
			</a>
		</div>

			<!-- Authentication Links -->
			@if (Auth::guard('company')->check())
				<div class="navbar-top-links navbar-right">
						<p>
							<a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logg ut</a>
							<form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</p>
				</div>
				<div class="navbar-top-links navbar-right">
					<p>
						<a href="{{ route('company.dashboard') }}">
							<button type="button" class="btn btn-primary" style="color:white">Min side</button>
						</a>
					</p>
				</div>
			@elseif (Auth::guard('privateUser')->check())
				<div class="navbar-top-links navbar-right">
						<p>
							<a href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logg ut</a>
							<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</p>
				</div>
				<div class="navbar-top-links navbar-right">
					<p>
						<a href="{{ route('user.dashboard') }}">
							<button type="button" class="btn btn-primary" style="color:white">Min side</button>
						</a>
					</p>
				</div>
			@else
				<div class="navbar-top-links navbar-right">
					<a href="#" data-toggle="modal" data-target="#loginAsCompanyUser">Logg inn som en fagman</a>
				</div>
				<div class="navbar-top-links navbar-right">
					<a href="#" data-toggle="modal" data-target="#loginAsPrivateUser">Logg inn som en kunde</a>
				</div>
			@endif
		</div>
</nav>

<!-- Modal -->
<div class="modal fade" id="loginAsCompanyUser">
  <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-horizontal" method="POST" action="{{ route('company.login.submit') }}">
          {{ csrf_field() }}
          <div class="modal-header">
              <h3 class="modal-title">Login som en fagman</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              @include('no.includes.forms.login_as_company_user')
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
              <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginAsPrivateUser">
  <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-horizontal" method="POST" action="{{ route('user.login.submit') }}">
          {{ csrf_field() }}
          <div class="modal-header">
              <h3 class="modal-title">Login som en kunde</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              @include('no.includes.forms.login_as_private_user')
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
              <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
  </div>
</div>
