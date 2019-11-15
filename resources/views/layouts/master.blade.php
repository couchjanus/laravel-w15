<!DOCTYPE html>
<!-- Stored in resources/views/layouts/master.blade.php -->
<html lang="{{ Str::replaceFirst('_', '-', app()->getLocale()) }}">

<head>
   <!-- Meta -->
    @include('layouts.partials.shared._meta')
    @yield('meta')
    <!-- Fonts -->
    @include('layouts.partials.shared._fonts')
    @yield('fonts')
    <!-- Styles -->
    @include('layouts.partials.shared._styles')
    @yield('styles')
</head>

<body class=@yield('body_class', "body")>
   @yield('navbar')
   @yield('main')
   @yield('footer')
   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>
   @yield('scripts')
</body>
