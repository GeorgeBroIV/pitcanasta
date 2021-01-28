<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('_layouts.head')
</head>
<body>
<div id="app">
	@if (Route::current() == null || Route::current()->getName() != 'welcome')
		@include('_layouts.nav')
	@endif
	<main class="py-4">
		@yield('content')
	</main>
	@include('_layouts.footer')
</div>
</body>
</html>