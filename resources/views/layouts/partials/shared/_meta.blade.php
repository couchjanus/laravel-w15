<!-- Stored in resources/views/layouts/partials/shared/_meta.blade.php -->   
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
