@extends('layouts.dashboard')
@section('title', 'Pendaftaran Murid Baru')
@section('content')
<x-page-title>
    <x-slot name="title">Murid</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Murid</li>
        <li class="breadcrumb-item active">Daftar</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Pendaftaran Murid Baru</h3>
                {!! Form::open(['route' => 'murid.store', 'class' => 'form-horizontal form-wizard-wrapper', 'enctype' =>
                'multipart/form-data', 'id' => 'form-horizontal']) !!}
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <small class="text-danger">*</small></label>
                            {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Murid', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">Nomor Induk Siswa Nasional <small
                                    class="text-danger">*</small></label>
                            {!! Form::text('nisn', null, ['class' => 'form-control', 'placeholder' => 'NISN',
                            'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">Nomor Induk Siswa <small class="text-danger">*</small></label>
                            {!! Form::text('nis', null, ['class' => 'form-control', 'placeholder' => 'NIS', 'required'])
                            !!}
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
                    <label for="fotomurid">Foto Murid <small class="text-danger">Opsional</small></label>
                    <div>
                        <img src="{{ asset('/images/user-no-border.svg') }}" alt="" class="mb-2" id="preview-image"
                            style="border: 1px solid #000; width:128px; height:auto;object-fit: cover;">
                    </div>
                    {!! Form::file('fotomurid', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
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
    $(function () {
        let form = $("#form-horizontal");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                password_confirmation: {
                    equalTo: "#password"
                }
            }
        });

        $("input[name='fotomurid']").change(function () {
            readUrl(this);
        });

        function readUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#preview-image").attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    });

</script>
@endsection
