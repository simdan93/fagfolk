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
					<a href="{{ route('company.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
				</li>
				<li {{ (Request::is('/min-profil') ? 'class="active"' : '') }}>
					<a href="{{ route('company.profile') }}"><i class=""></i> Min profil</a>
				</li>
				<li {{ (Request::is('/mine-servicer') ? 'class="active"' : '') }}>
					<a href="{{ route('company.services') }}"><i class=""></i> Mine servicer</a>
				</li>
				<li {{ (Request::is('/forespoorsler') ? 'class="active"' : '') }}>
					<a href="{{ route('company.requests') }}"><i class=""></i> Forespørsler</a>
				</li>
				<li{{ (Request::is('/responser-fra-kunder') ? 'class="active"' : '') }}>
					<a href="{{ route('company.usersResponses') }}"><i class=""></i> Responser fra kunder</a>
				</li>
				<li></li>
				<li {{ (Request::is('/finn-hjelp') ? 'class="active"' : '') }}>
					<a href="{{ route('findHelpCompany') }}"><i class=""></i> Finn fagfolk</a>
				</li>
				<li></li>
				<li{{ (Request::is('/mine-behov') ? 'class="active"' : '') }}>
				 <a href="{{ route('company.usersNeeds') }}"><i class=""></i> Mine behov</a>
			 </li>
				<li{{ (Request::is('/responser-på-mine-behov') ? 'class="active"' : '') }}>
					<a href="{{ route('company.myNeedResponses') }}"><i class=""></i> Responser på mine behov</a>
				</li>
				<li></li>
				<li{{ (Request::is('/konfigurasjoner') ? 'class="active"' : '') }}>
					<a href="{{ route('company.details') }}"><i class="fas fa-sliders-h"></i> Konfigurasjoner</a>
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
