<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/font-awesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-DEXFC3C67M"></script>
    
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-DEXFC3C67M');
	</script>

    <title>Indekosta, Sistem Pencarian Kost | {{ $title }}</title>

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Component Style -->
    @yield('styles')
</head>
<body>
    
    @yield('content')
    @livewireScripts
	
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	
    <!--Vendors-->
    <script src="{{ asset('frontend/vendor/ityped/index.js') }}"></script>
    <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
	
    <!-- Theme Functions -->
    <script src="{{ asset('frontend/js/functions.js') }}"></script>
	
    <!-- Livewire Styles -->
    @stack('scripts')
</body>
</html>