<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<!-- head content -->
	@include('no.includes.head')
</head>

<body>
	<!-- header grid -->
		@include('no.includes.header_fixed')
	<!-- sidebar  -->
		@yield('content')
	<!-- footer content -->
		@include('no.includes.footer')
	<!-- Javascripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.js') }}"></script>
	@yield('scripts')
</body>
</html>
