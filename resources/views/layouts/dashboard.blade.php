<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- Template and custom --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favico.ico') }}">
    <link rel="stylesheet" href="{{ asset('/css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/optional.css') }}">
    
    @livewireStyles

    @yield('css')
</head>
<body data-layout="detached" data-topbar="colored">
    <div class="container-fluid">
        <div id="layout-wrapper">
            <header id="page-topbar">
                <x-topbar></x-topbar>
            </header>
            <x-sidebar></x-sidebar>
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <x-footer></x-footer>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/dependencies.js') }}"></script>

    <script src="{{ asset('/js/app.js') }}"></script>

    @livewireScripts

    @stack('scripts')
    @yield('js')

    @include('sweetalert::alert')
</body>
</html>