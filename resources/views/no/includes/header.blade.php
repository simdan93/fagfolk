<nav class="navbar navbar-default navbar-static-top .navbar-top-placement" role="navigation" style="margin-bottom: 0">
	<div class="navbar-top-links-box">
		<div class = "navbar-header" style="height: 80px;">
			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}" style="padding: 5px">
				<img src="/images/Logoer/Fagfolk.grear_.big_-300x63.png">
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
			<!--
			<div class="navbar-top-links navbar-right">
				<p>
					<a href="{{ route('company.dashboard') }}">
						<button type="button" class="btn btn-primary" style="color:white">Min side</button>
					</a>
				</p>
			</div>
		-->
			<div class="navbar-top-links navbar-right">
				<?php $selskap = session('selskap');
				$org_nummer = session('org_nummer');?>
				@if ($selskap != '' && $org_nummer != '')
					<p><b>Selskapsnavn: </b>{{ $selskap }} <b>Org.: </b>{{ $org_nummer }}</p>
				@endif
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
			<!--
			<div class="navbar-top-links navbar-right">
				<p>
					<a href="{{ route('user.dashboard') }}">
						<button type="button" class="btn btn-primary" style="color:white">Min side</button>
					</a>
				</p>
			</div>
		-->
		@else
			<div class="navbar-top-links navbar-right">
				<a href="{{ route('company.login') }}"><button type="button" class="btn btn-primary" style="color:white">Logg inn som en fagman</button></a>
			</div>
			<div class="navbar-top-links navbar-right">
				<a href="{{ route('user.login') }}"><button type="button" class="btn btn-primary" style="color:white">Logg inn som en kunde</button></a>
			</div>
		@endif
	</div>
</nav>
