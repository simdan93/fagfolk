<div class = "navbar-header">
	<!-- Collapsed Hamburger -->
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	
	<!-- Branding Image -->
	<a class="navbar-brand" href="{{ url('/en') }}">
		<span style="font-size: 42px"> 
			{{ config('app.name', 'Laravel') }}
		</span>
	</a>
</div>

<div class="collapse navbar-collapse" id="app-navbar-collapse">
	<!-- Left Side Of Navbar -->
	<ul class="nav navbar-nav">
		&nbsp;
	</ul>
	
	<!-- Right Side Of Navbar -->
	<ul class="nav navbar-nav navbar-right">
		<!-- Authentication Links -->
		@if (Auth::guard('company')->check())
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::guard('company')->user()->name }} <span class="caret"></span>
				</a>

				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{{ route('company.logout') }}"
							onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							Logout
						</a>

						<form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
			<li><a href="{{ route('company.dashboard') }}">My COMPANY Page</a><li>
		@elseif (Auth::guard('privateUser')->check())
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::guard('privateUser')->user()->name }} <span class="caret"></span>
				</a>

				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{{ route('user.logout') }}"
							onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							Logout
						</a>

						<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
			<li><a href="{{ route('user.dashboard') }}">My USER Page</a><li>
		@else
			<li><a href="{{ route('user.login') }}">Login</a></li>
			<li><a href="{{ route('company.login') }}">Login as company</a></li>
		@endif										
	</ul>
</div>
