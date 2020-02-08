<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Aquaticazul')">
    <meta name="author" content="@yield('meta_author', 'Flores Raul')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="aquaticazul, acuatica, aqua, azul, acuaticazul">
    @yield('meta')

    @stack('before-styles')
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- inject:css-->

    <link rel="stylesheet" href="{{ asset('/pro/css/plugin.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/pro/style.css') }}">

    <!-- endinject -->

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/pro/img/azul162.png') }}">
    @stack('after-styles')

</head>
<body class="preload">
    @include('includes.partials.demo')
    @include('includes.partials.logged-in-as')

    @include('frontend.includes2.menuarea')

        @yield('content')

    @include('frontend.includes2.footer')

    @stack('before-scripts')

    {{-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U"></script> --}}
    <!-- inject:js-->

     <script src="{{ asset('/pro/js/plugins.min.js') }}"></script>

     <script src="{{ asset('/pro/js/script.min.js') }}"></script>

     <!-- endinject-->
    @stack('after-scripts')

</body>

</html>