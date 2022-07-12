<div class="navbar-header">
    <div class="container-fluid">
        <div class="float-right">
            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ Auth::guard('admin')->user()->guru->foto !== null ? url('storage/guru/foto/' . Auth::guard('admin')->user()->guru->foto) : asset('/images/user.svg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ml-1">{{ Auth::guard('admin')->user()->nama }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('guru.show', Auth::guard('admin')->user()->guru_id) }}"><i class="bx bx-user font-size-16 align-middle mr-1"></i>
                        Profil Saya</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                </div>
            </div>

            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect" id="btnSettings">
                <i class="mdi mdi-settings-outline"></i>
            </button>

        </div>
        <div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        $('#btnSettings').click(function() {
            let settingsPage = "{{ route('settings') }}";

            window.location.href = settingsPage;
        });
    </script>
@endpush
