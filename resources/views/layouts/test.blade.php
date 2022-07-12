<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favico.ico') }}">
    <link rel="stylesheet" href="{{ asset('/css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/test-optional.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/sweetalert2/sweetalert2.min.css') }}">

    @yield('additional')
    @livewireStyles

</head>
<body oncopy="return false" oncut="return false" onpaste="return false">
    <noscript>
        <div class="flex w-100 h-10 bg-red-500 text-white justify-center items-center">
            Javascript dinonaktifkan
        </div>
    </noscript>
    @livewire('test-modal', ['jadwal' => $jadwal ?? ""])
    @livewire('modal-info')
    <x-test-sidebar :soal="$soal ?? ''"></x-test-sidebar>
    <x-test-navbar></x-test-navbar>
    <div class="wrapper">
        @yield('content')
    </div>
    @if(Request::is('ujian'))
        @livewire('button-footer', ['soal' => $soal ?? "", 'jadwal' => $jadwal])
    @endif
    <script>
        const btnIcon = document.querySelector('.btn-icon');
        const btnDrop = document.querySelector('#toggleBtn');
        
        let footer = document.querySelector('footer');
        let content = document.querySelector('.wrapper');

        let dropdownMenu = document.querySelector('.dropdown-menu');

        if(btnDrop) {
            btnDrop.addEventListener('click', () => {
                if(dropdownMenu) dropdownMenu.classList.toggle('show');

            });
        }

        document.addEventListener('click', (e) => {
            if(!e.target.matches('#toggleBtn')) {
                if(dropdownMenu) dropdownMenu.classList.remove('show'); 
            }
        });

    </script>
    <script src="{{ asset('/js/moment.js') }}"></script>
    <script src="{{ asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    @yield('js')
    @stack('scripts')
    @livewireScripts

</body>
</html>