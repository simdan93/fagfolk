<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<!-- head content -->
		@include('includes.head')
	</head>
   
	<body>
		<!-- sidebar content -->
		<!-- header content -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class = "container">
				<header class="row">
					@include('includes.header')
				</header>
			</div>
		</nav>
		
		<div class = "container">
			<!-- main content -->
			<div id="main" class="row">
				<div class="col-md-12">
					@yield('content')
				</div>
			</div>
			<!-- footer content -->
			 <footer class="row">
			 	<div class="col-md-12">
			 		@include('includes.footer')
			 	</div>
			</footer>
		</div>
		
		<!-- Javascripts -->
		<script src="{{ asset('js/app.js') }}"></script>
		@yield('scripts')
		
	</body>
</html>