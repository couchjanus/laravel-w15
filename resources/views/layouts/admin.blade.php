@extends('layouts.master')

@section('meta')
   <!-- Custom meta for this template -->
   @include('layouts.partials.admin._meta')
@endsection

@section('styles')
   <!-- Custom styles for this template -->
   @include('layouts.partials.admin._styles')
@endsection

@section('body_class')
  "bg-gray-900 font-sans leading-normal tracking-normal mt-12"
@endsection

@section('navbar')
    @include('layouts.partials.admin._navbar')
@endsection

@section('main')                    
    <div class="flex flex-col md:flex-row">
        <div class="bg-gray-900 shadow-lg h-16 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48">
            <!-- Sidebar -->
            @include('layouts.partials.admin._sidebar')
        </div>

        <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            @yield('breadcrumb')
            @yield('content')
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Custom scripts for this template -->
    @include('layouts.partials.admin._scripts')
@endsection
