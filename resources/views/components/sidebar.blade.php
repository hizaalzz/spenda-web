<div class="vertical-menu z-50 overflow-auto">
    <div class="h-100">
        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ Auth::guard('admin')->user()->guru->foto !== null ? url('/storage/guru/foto/' . Auth::guard('admin')->user()->guru->foto) : asset('/images/user.svg') }}" alt="" 
                class="avatar-lg mx-auto rounded-circle" style="object-fit: cover;">

            </div>
            <div class="mt-3">
                <a href="#"
                    class="text-dark font-weight-medium font-size-16">{{ Auth::guard('admin')->user()->nama }}</a>
                <p class="text-body mt-1 mb-0 font-size-13">
                    {{ Auth::guard('admin')->user()->superadmin ? 'Super Admin' : 'Guru' }}</p>
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- content menu --}}
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penilaian.index') }}" class="waves-effect">
                        <i class="mdi mdi-lead-pencil"></i>
                        <span>Hasil Ujian</span>
                    </a>
                </li>

                {{-- content manajemen --}}
                <li class="menu-title">Manajemen</li>
                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="mdi mdi-database"></i>
                        <span>Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('viewAny', App\Models\Admin::class)
                        <li>
                            <a href="{{ route('admin.index') }}">
                                <i class="mdi mdi-account-star"></i>
                                <span>Data Admin</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Guru::class)
                        <li>
                            <a href="{{ route('guru.index') }}"
                                class="waves-effect @if(Request::is('guru') || Request::is('guru/*')) mm-active @endif">
                                <i class="mdi mdi-account-tie"></i>
                                <span>Data Guru</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Murid::class)
                        <li>
                            <a href="{{ route('murid.index') }}"
                                class="waves-effect @if(Request::is('murid') || Request::is('murid/*')) mm-active @endif">
                                <i class="mdi mdi-account-supervisor"></i>
                                <span>Data Murid</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Jadwal::class)
                        <li>
                            <a href="{{ route('jadwal.index') }}" class="waves-effect @if(Request::is('jadwal') || Request::is('jadwal/*')) mm-active @endif">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>Data Jadwal</span>
                            </a>
                        </li>
                        @endcan
                        @if(Auth::guard('admin')->check())
                        <li>    
                            <a href="{{ route('jenisujian.index') }}" class="waves-effect @if(Request::is('jenisujian') || Request::is('jenisujian/*')) mm-active @endif">
                                <i class="mdi mdi-format-list-checkbox"></i>
                                <span>Data Jenis Ujian</span>
                            </a>  
                        </li>
                        @endif
                        @can('viewAny', App\Models\Kelas::class)
                        <li>
                            <a href="{{ route('class.index') }}" class="waves-effect @if(Request::is('class') || Request::is('class/*')) mm-active @endif">
                                <i class="mdi mdi-google-classroom"></i>
                                <span>Data Kelas</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Level::class)
                        <li>
                            <a href="{{ route('level.index') }}" class="waves-effect @if(Request::is('level') || Request::is('level/*')) mm-active @endif">
                                <i class="mdi mdi-poll"></i>
                                <span>Data Level</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Paket::class)
                        <li>
                            <a href="{{ route('paket.index') }}" class="waves-effect @if(Request::is('paket') || Request::is('paket/*')) mm-active @endif">
                                <i class="mdi mdi-gift-outline"></i>
                                <span>Data Paket</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Ruangan::class)
                        <li>
                            <a href="{{ route('ruangan.index') }}" class="waves-effect @if(Request::is('ruangan') || Request::is('ruangan/*')) mm-active @endif">
                                <i class="mdi mdi-home-account"></i>
                                <span>Data Ruangan</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Sesi::class)
                        <li>
                            <a href="{{ route('sesi.index') }}" class="waves-effect @if(Request::is('sesi') || Request::is('sesi/*')) mm-active @endif">
                                <i class="mdi mdi-av-timer"></i>
                                <span>Data Sesi</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', App\Models\Jurusan::class)
                        <li>
                            <a href="{{ route('tingkat.index') }}" class="waves-effect @if(Request::is('tingkat') || Request::is('tingkat/*')) mm-active @endif">
                                <i class="mdi mdi-stairs"></i>
                                <span>Data Tingkat Kelas</span>
                            </a>
                        </li> 
                        @endcan
                        @can('viewAny', App\Models\Matapelajaran::class)
                        <li>
                            <a href="{{ route('matapelajaran.index') }}" class="waves-effect @if(Request::is('matapelajaran') || Request::is('matapelajaran/*')) mm-active @endif">
                                <i class="mdi mdi-notebook"></i>
                                <span>Mata Pelajaran</span>
                            </a>  
                        </li>
                        @endcan
                        @can('viewAny', App\Models\BankSoal::class)
                        <li>
                            <a href="{{ route('banksoal.index') }}" class="waves-effect @if(Request::is('banksoal') || Request::is('banksoal/*')) mm-active @endif">
                                <i class="mdi mdi-bank"></i>
                                <span>Bank Soal</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @if(auth('admin')->user()->hasRole('admin'))
                <li>
                    <a href="{{ route('kelasmurid.index') }}" class="waves-effect @if(Request::is('kelasmurid') || Request::is('kelasmurid/*')) mm-active @endif">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Kelas Murid</span>
                    </a>
                </li>
                <li class="menu-title">Ujian</li>
                <li>
                    <a href="{{ route('pelaksanaan.kelas') }}" class="waves-effect @if(Request::is('pelaksanaan') || Request::is('pelaksanaan/*')) mm-active @endif">
                        <i class="mdi mdi-segment"></i>
                        <span>Pelaksanaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('aktivasi.index') }}" class="waves-effect @if(Request::is('aktivasi') || Request::is('aktivasi/*')) mm-active @endif">
                        <i class="mdi mdi-lan-check"></i>
                        <span>Aktivasi Ujian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('log.index') }}" class="waves-effect @if(Request::is('aktivitas') || Request::is('aktivitas/*')) mm-active @endif">
                        <i class="mdi mdi-history"></i>
                        <span>Log Aktifitas</span>
                    </a>
                </li>
                <li class="menu-title">Backup & Restore</li>
                <li>
                    <a href="{{ route('import.index') }}" class="waves-effect @if(Request::is('importdata') || Request::is('importdata/*')) mm-active @endif">
                        <i class="mdi mdi-cloud-upload-outline"></i>
                        <span>Import Data</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('export.pdf.multiple') }}" class="waves-effect @if(Request::is('export/multiple')) mm-active @endif">
                        <i class="mdi mdi-cloud-print-outline"></i>
                        <span>Print Nilai</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
