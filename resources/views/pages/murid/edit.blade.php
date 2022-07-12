@extends('layouts.dashboard')
@section('title', 'Edit Murid')
@section('content')
<x-page-title>
    <x-slot name="title">Murid</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Murid</li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data {{ $murid->nama }}</h3>
                {!! Form::model($murid, ['route' => ['murid.update', $murid->id], 'id' => 'form-murid', 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama lengkap siswa/i', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">Nomor Induk Siswa Nasional</label>
                            {!! Form::text('nisn', null, ['class' => 'form-control', 'placeholder' => 'NISN', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">Nomor Induk Siswa</label>
                            {!! Form::text('nis', null, ['class' => 'form-control', 'placeholder' => 'NIS', 'required']) !!}
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
                                        {!! Form::radio('jenis_kelamin', 'L', 'checked', ['class' => 'form-check-input', 'id' => 'L']) !!}
                                        <label for="L" class="form-check-label">Laki-laki</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check mr-2">
                                        {!! Form::radio('jenis_kelamin', 'P', null, ['class' => 'form-check-input', 'id' => 'P']) !!}
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
                            <label for="tempat_lahir">Tempat Lahir</label>
                            {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'placeholder' => 'Tempat lahir', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $murid->tanggal_lahir }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="telp">No. Handphone <small class="text-danger">Opsional</small></label>
                            {!! Form::number('telp', null, ['class' => 'form-control', 'placeholder' => 'No. Handphone', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fotoguru">Foto Murid</label><br>

                    <div class="d-flex flex-column align-items-start mb-2">
                        <img src="{{ $murid->foto ? url('/storage/murid/foto') . '/' . $murid->foto : asset('/images/user-no-border.svg') }}" alt="" 
                        class="mb-2" style="max-width: 2cm; max-height: 3cm;" id="preview-image">
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
                        {!! Form::file('fotomurid', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Ganti Password</h3>
                {!! Form::open(['route' => 'change.murid.password', 'id' => 'form-password']) !!}
                {!! Form::hidden('user_id', $murid->user->id) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="password">Konfirmasi password</label>
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Konfirmasi password', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        let form = $('#form-murid');
        let formPassword = $('#form-password');

        formPassword.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
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

        $("input[name='fotomurid']").change(function() {
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
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        });
    </script>
@endsection
