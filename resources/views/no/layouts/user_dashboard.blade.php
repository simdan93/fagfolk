@extends('no.layouts.master_dashboard')
@section('title', 'Hjem')
@section('content')
<div class="wrapper">
	<!-- Sidebar -->
	<div class="navbar-default">
		<div class="column sidebar" >
			<ul class="nav">
				 <!--{{ (Request::is('/') ? 'class="active"' : '') }}-->
				<li {{ (Request::is('/') ? 'class="active"' : '') }}>
					<a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
				</li>
				<li {{ (Request::is('/finn-hjelp') ? 'class="active"' : '') }}>
					<a href="{{ route('findHelp') }}"><i class=""></i> Finn hjelp</a>
				</li>
				 <li{{ (Request::is('/mine-behov') ? 'class="active"' : '') }}>
					<a href="{{ route('user.usersNeeds') }}"><i class=""></i> Mine behov</a>
				</li>
				<li{{ (Request::is('/mine-responser') ? 'class="active"' : '') }}>
					<a href="{{ route('user.usersResponses') }}"><i class=""></i> Responser fra fagfolk</a>
				</li>
				<li{{ (Request::is('/mine-detaljer') ? 'class="active"' : '') }}>
					<a href="{{ route('user.details') }}"><i class="fas fa-sliders-h"></i> Konfigurasjoner</a>
				</li>
			 </ul>
		</div>
	</div>

	<!-- Content -->
	<div class="column page-wrapper">
		<h1 class="page-header"><b>@yield('page_heading')</b></h1>
		@yield('dashboard-content')
	</div>
	<!-- Right sidebar -->
	<div class="navbar-default">
		<div class="column sidebar-right">
			<h2><b>Forklaring</b></h2>
			@yield('right-sidebar-content')
		</div>
	</div>
</div>
@stop
