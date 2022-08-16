<nav class="flex items-center justify-between flex-wrap bg-white border-b shadow-sm">
    <div class="flex items-center flex-shrink-0 text-gray-900 mr-6 pl-4 py-2">
        <span class="font-semibold text-lg tracking-tight ml-2"></span>
    </div>
    @if(!Request::is('ujian'))
    <div class="block md:hidden lg:hidden">
        <button class="flex items-center px-3 py-2 mr-2 border rounded text-teal-200 border-teal-400 hover:text-gray-400 hover:border-white burger"
        onclick="toggle()">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
        </button>
    </div>
    @endif
    <div class="@if(!Request::is('ujian'))w-full @endif md:w-auto lg:w-auto md:flex lg:flex items-center @if(!Request::is('ujian'))hidden @endif " id="extend-nav">
        <ul class="flex mr-3">
            <li class="dropdown z-40">
                <button id="toggleBtn" class="flex @if(Request::is('ujian')) hidden @endif px-3 py-2 m-auto font-semibold text-sm
                     text-gray-700 hover:text-gray-900 focus:outline-none items-center">
                    <img src="{{ $fotoMurid ? url('/storage/murid/foto') . '/' . $fotoMurid : asset('/images/user2.svg') }}" alt=""
                    class="w-8 h-8 rounded-full object-cover">
                    <span class="ml-2">{{ auth()->user()->nama ?? "Tamu" }}</span>
                </button>
                @if(!Request::is('ujian'))
                <ul class="dropdown-menu w-48 absolute md:right-0 lg:right-0 bg-white shadow hidden text-gray-700 rounded">
                    <li>
                        <a class="w-full rounded-t hover:bg-gray-400 py-2 px-6 block whitespace-no-wrap" href="{{ route('ujian.account') }}">Profile</a>
                    </li>
                    <li>
                        <a class="w-full rounded-b hover:bg-gray-400 py-2 px-6 block whitespace-no-wrap" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
                @endif
            </li>
        </ul>
        @if(Request::is('ujian'))
        <button class="px-3 py-1 mr-2 bg-blue-500 text-white rounded shadow inline-flex items-center menu text-sm hover:bg-blue-400 focus:outline-none">
            {{-- <i class="fas fa-bars mr-2 btn-icon"></i> --}}
            {{-- Daftar Soal --}}
        </button>
        @endif
    </div>
</nav>
@push('scripts')
    <script>
        function toggle() {
            let extendNav = document.querySelector('#extend-nav');

            extendNav.classList.toggle('nav-show');
        }
    </script>
@endpush
