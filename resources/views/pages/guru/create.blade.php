@extends('layouts.dashboard')
@section('title', 'Daftar Guru')
@section('content')
<x-page-title>
    <x-slot name="title">Guru</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Guru</li>
        <li class="breadcrumb-item active">Daftar</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Pendaftaran</h3>
                {!! Form::open(['route' => 'guru.store', 'class' => 'form-horizontal form-wizard-wrapper', 'id' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                <h3>Data Guru</h3>
                @if(Route::current()->getName() == 'admin.create')
                    {!! Form::hidden('superadmin', true) !!}
                @endif
                <fieldset>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap <small class="text-danger">*</small></label>
                                {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nisn">NUPTK <small class="text-danger">Opsional</small></label>
                                {!! Form::text('nuptk', null, ['class' => 'form-control', 'placeholder' => 'NUPTK', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nisn">Email <small class="text-danger">*</small></label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
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
                                <label for="tempat_lahir">Tempat Lahir <small class="text-danger">Opsional</small></label>
                                {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'placeholder' => 'Tempat lahir']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir <small class="text-danger">*</small></label>
                                {!! Form::input('date', 'tanggal_lahir', '2000-06-20', ['class' => 'form-control', 'required']) !!}
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
                        <label for="fotomurid">Foto <small class="text-danger">Opsional</small></label>
                        <div>
                            <img src="{{ asset('/images/user-no-border.svg') }}" alt="" class="mb-2" id="preview-image" 
                            style="border: 1px solid #000; width:128px; height:auto;object-fit: cover;">
                        </div>
                        {!! Form::file('fotoguru', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                    </div>
                </fieldset>
                <h3>Kredensial</h3>
                <fieldset>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="usepassword" id="usepassword" checked>
                        <label for="usepassword">Buat password otomatis</label>
                    </div>
                    <div class="row">
                        <div class="col" id="col-password">
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="col-confirm">
                           
                        </div>
                    </div>
                </fieldset>
                <h3>Pilih Mata Pelajaran</h3>
                <fieldset>
                    <label for="table-mapel">Pilih Mata Pelajaran</label>
                    <div class="table-responsive">
                        <table class="table" id="matapelajaran-table" style="width:100% !important;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama Mata Pelajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listMatapelajaran as $matapelajaran)
                                    <tr>
                                        <td>{!! Form::checkbox('matapelajaran[]', $matapelajaran->id, false) !!}</td>
                                        <td>{{ $matapelajaran->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script>
    $(function() {
        let form = $("#form-horizontal");

        form.steps({
            headerTag:"h3",
            bodyTag:"fieldset",
            transitionEffect:"slide",
            onStepChanging: function(event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function(event, currentIndex) { 
                form.submit();
            }
        });

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        });
        
        $('#matapelajaran-table').DataTable({
            paging: false,
            columnDefs: [
                { width: "10%", orderable: false, targets: 0 }
            ],
            order: [
                [1, 'asc']
            ]
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

        $("#usepassword").change(function() {
            const passwordField = `<div class="form-group" id="password">
                                <label for="password">Password</label>
                                <input type='password' name='password' class='form-control' placeholder='Password'>
                                </div>`;
            const passwordConfirmField = `<div class="form-group" id="password_confirmation">
                                <label for="password">Konfirmasi password</label>
                                <input type='password' name='password_confirmation' class='form-control' placeholder='Password'>
                                </div>`;

            let password = $('#password');
            let passwordConfirm = $('#password_confirmation');

            if($(this).is(':checked')) {
                password.remove();
                passwordConfirm.remove();

                
            } else {
                $('#col-password').append(passwordField);
                $('#col-confirm').append(passwordConfirmField);
            }
        });
    });
</script>
@endsection