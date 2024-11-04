<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        @if (trim($__env->yieldContent('title')))
        @yield('title') | {{ config('app.name', 'Laravel') }}
        @else
        {{ config('app.name', 'Laravel') }}
        @endif
    </title>
    <meta name="theme-color" content="#ffffff">
    @stack('before-styles')
    @vite('resources/sass/app.scss')
    @stack('after-styles')
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
                <img src="{{ asset('img/hospitals_logo.jpg') }}" class="rounded-circle mt-2 mb-2" alt="Hospital Logo" style="width: 120px; height: auto;">
        </div>
        @include('layouts.navigation')
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <!-- Header block -->
        @include('layouts.includes.header')
        <!-- / Header block -->

        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <!-- Errors block -->
                @include('layouts.includes.errors')
                <!-- / Errors block -->
                <div class="mb-4">@yield('content')</div>
            </div>
        </div>

        <!-- Footer block -->
        @include('layouts.includes.footer')
        <!-- / Footer block -->
    </div>

    <!-- Scripts -->
    @stack('before-scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    @vite('resources/js/app.js')

    @yield('scripts')

    @stack('after-scripts')
    <!-- / Scripts -->

</body>

</html>
