<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<!-- head content -->
	@include('no.includes.head')
</head>

<body>
	<!-- header grid -->
		@include('no.includes.header')
	<!-- sidebar  -->
		@yield('content')
	<!-- footer content-->
		@include('no.includes.footer')
	<!-- Javascripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNZynpno29HkXcmf497_lZPMyVtTIGdnQ&callback=initMap">
	</script>
	@yield('scripts')
</body>
</html>
