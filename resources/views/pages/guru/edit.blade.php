@extends('layouts.dashboard')
@section('title', 'Edit Guru')
@section('css')
    <link rel="stylesheet" href="{{ asset('/libs/select2/css/select2.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Guru</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Guru</li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data {{ $guru->nama }}</h3>
                {!! Form::model($guru, ['route' => ['guru.update', $guru->id], 'class' => 'form-horizontal
                form-wizard-wrapper', 'id' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <small class="text-danger">*</small></label>
                            {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap',
                            'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">NUPTK <small
                                    class="text-danger">Opsional</small></label>
                            {!! Form::text('nuptk', null, ['class' => 'form-control', 'placeholder' => 'NUPTK']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">Email <small class="text-danger">*</small></label>
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email',
                            'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check mr-2">
                                        {!! Form::radio('jenis_kelamin', 'L', 'checked', ['class' => 'form-check-input',
                                        'id' => 'L']) !!}
                                        <label for="L" class="form-check-label">Laki-laki</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check mr-2">
                                        {!! Form::radio('jenis_kelamin', 'P', null, ['class' => 'form-check-input', 'id'
                                        => 'P']) !!}
                                        <label for="P" class="form-check-label">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir <small class="text-danger">Opsional</small></label>
                            {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'placeholder' => 'Tempat lahir']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir <small class="text-danger">*</small></label>
                            {!! Form::input('date', 'tanggal_lahir', '2000-06-20', ['class' => 'form-control',
                            'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="telp">No. Handphone <small class="text-danger">Opsional</small></label>
                            {!! Form::number('telp', null, ['class' => 'form-control', 'placeholder' => 'No. Handphone']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fotoguru">Foto</label><br>

                    <div class="d-flex flex-column align-items-start mb-2">
                        <img src="{{ $guru->foto ? url('/storage/guru/foto') . '/' . $guru->foto : asset('/images/user-no-border.svg') }}" alt="" 
                        class="mb-2" id="preview-image" style="max-width: 2cm; max-height: 3cm;">
                        <div>
                            <button type="button" class="btn btn-success btn-sm" id="ganti-foto" class="mt-2">
                                <i class="fas fa-file-image"></i> Ganti foto
                            </button>
                            <button type="button" class="btn btn-danger btn-sm d-none" id="cancel-foto">
                                <i class="fas fa-times"></i> Batal
                            </button>
                        </div>
                    </div>

                    <div class="d-none" id="input-foto">
                        {!! Form::file('fotoguru', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Mata Pelajaran</h3>
                {!! Form::open(['route' => ['gurumapel.remove', $guru->id], 'id' => 'removemapel', 'data-target' => $guru->id]) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                    </div>
                    <div class="mb-2">
                        <a href="#" onclick="showModal(`Apakah anda yakin ingin menghapus mata pelajaran untuk {{ $guru->nama }} ?`, `#removemapel`, `{{ $guru->id }}`);" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash mr-1"></i>Hapus yang dipilih
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{!! Form::checkbox('check_all', 'check_all', false, ['id' => 'check_all', 'required']) !!}</th>
                                <th>Nama Mata Pelajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guru->matapelajaran as $matapelajaran)
                                <tr>
                                    <td>{!! Form::checkbox('matapelajaran[]', $matapelajaran->id, false, ['class' => 'check_matapelajaran', 'required']) !!}</td>
                                    <td>
                                        {{ $matapelajaran->nama }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak ada mata pelajaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {!! Form::close() !!}
                <p class="text-primary mb-2 mt-4">Pilih Mata Pelajaran</p>
                <div class="mb-4">
                    {!! Form::open(['route' => ['gurumapel.store', $guru->id]]) !!}
                    @csrf
                    {!! Form::select('matapelajaran', $listMatapelajaran, null, ['class' => 'form-control', 'id' => 'mapelselect']) !!}
                    <div class="text-center mt-2">
                        {!! Form::submit('Tambahkan', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-4">Ganti Password</h3>
                {!! Form::open(['route' => 'change.password', 'id' => 'form-password']) !!}
                @csrf
                {!! Form::hidden('admin_id', $guru->admin->id) !!}
                @if(!auth()->user()->hasRole('admin'))
                <div class="form-group">
                    <label for="old_password">Password Lama</label>
                    {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Masukkan password lama', 'required']) !!}
                </div>
                @endif
                @if($guru->admin->hasRole('admin'))
                <div class="form-group">
                    <label for="old_password">Password Lama</label>
                    {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Masukkan password lama', 'required']) !!}
                </div>
                @endif
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukkan password baru', 'id' =>
                    'password', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="password">Konfirmasi password</label>
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' =>
                    'Konfirmasi password', 'required']) !!}
                </div>
                <div class="form-group">
                    <div class="text-center">
                        {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@section('js')
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>

<script>
    let form = $('#form-horizontal');
    let formPassword = $('#form-password');

    $(document).ready(function() {
        $('#mapelselect').select2();
    });

    $('#check_all').change(function(e) {
        $('.check_matapelajaran').prop('checked', e.target.checked);
        
    });

    formPassword.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            password_confirmation: {
                equalTo: "#password"
            }
        }
    });

    $('#ganti-foto').click(function() {
        let inputFoto = $('#input-foto');
        let cancelFoto = $('#cancel-foto');

        if(inputFoto.hasClass('d-none') && cancelFoto.hasClass('d-none')) {
            inputFoto.removeClass('d-none');

            cancelFoto.removeClass('d-none');
            $(this).addClass('d-none');
        }
    });

    $('#cancel-foto').click(function() {
        let inputFoto = $('#input-foto');
        let gantiFoto = $('#ganti-foto');

        if(!inputFoto.hasClass('d-none') && gantiFoto.hasClass('d-none')) {
            inputFoto.addClass('d-none');

            gantiFoto.removeClass('d-none');
            $(this).addClass('d-none');
        }
    });

    $("input[name='fotoguru']").change(function() {
        readUrl(this);
    });

    function readUrl(input)  {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
                        
            reader.onload = function(e) {
                $("#preview-image").attr('src', e.target.result);
            }
                        
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        }
    });

</script>
@endsection
