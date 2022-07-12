@extends('layouts.dashboard')
@section('title', 'Buat jadwal baru')
@section('content')
<x-page-title>
    <x-slot name="title">Jadwal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jadwal</li>
        <li class="breadcrumb-item active">Tambah Jadwal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Jadwal Ujian</h3>
                {!! Form::open(['route' => 'jadwal.store', 'id' => 'form-jadwal', 'class' => 'form-horizontal form-wizard-wrapper']) !!}
                <h3>Pilih Kelas</h3>
                <fieldset>
                    <div class="form-group">
                        <label for="kelas_id">Pilih Kelas</label>
                        {!! Form::select('kelas_id', $kelas, null, ['class' => 'form-control', 'id' => 'kelas_id', 'required']) !!}
                    </div>
                </fieldset>
                <h3>Mata Pelajaran</h3>
                <fieldset>
                    <div class="form-group">
                        <label for="matapelajaran_id">Mata Pelajaran</label>
                        {!! Form::select('matapelajaran_id', ['' => 'Pilih Kelas terlebih dahulu'], null, ['class' => 'form-control', 'id' => 'matapelajaran_id', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="guru_id">Pilih Guru</label>
                        {!! Form::select('guru_id', ['' => 'Pilih Mata Pelajaran Terlebih Dahulu'], null, ['class' => 'form-control', 'id' => 'guru_id', 'required']) !!}
                    </div>
                </fieldset>
                <h3>Data Jadwal</h3>
                <fieldset>
                    <div class="form-group">
                        <label for="nama">Nama Jadwal</label>
                        {!! Form::text('nama', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Nama Jadwal', 'required']) !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal">Tanggal Dimulai</label>
                                {{ Form::input('date', 'tanggal', null, ['class' => 'form-control', 'required']) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_expire">Waktu Selesai</label>
                                {!! Form::time('tanggal_expire', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenisujian_id">Jenis Ujian</label>
                        {!! Form::select('jenisujian_id', $jenisujian, null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="bank_soal_id">Bank Soal</label>
                        {!! Form::select('bank_soal_id', ['Pilih kelas terlebih dahulu' => ''], null, ['class' => 'form-control', 'id' => 'bank_soal_id']) !!}
                    </div>
                    <div>
                        <i class="mdi mdi-information-outline"></i>
                        <span class="text-muted text-sm">Bank soal menentukan soal yang akan digunakan pada saat ujian. Dapat dikosongkan apabila belum membuat bank soal</span>
                    </div>
                </fieldset>
                <h3>Bobot Nilai</h3>
                <fieldset>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="bobot_pg">Bobot PG (%)</label>
                                {!! Form::number('bobot_pg', null, ['class' => 'form-control', 'placeholder' => 'Bobot soal PG %']) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="bobot_essay">Bobot Essay (%)</label>
                                {!! Form::number('bobot_essay', null, ['class' => 'form-control', 'placeholder' => 'Bobot soal Essay %']) !!}
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="mdi mdi-information-outline"></i>
                        <span class="text-muted text-sm">Dapat dikosongkan salah satu apabila tidak terdapat soal PG ataupun Essay</span>
                    </div>
                    <div class="form-group mt-4">
                        <label for="kkm">Nilai KKM</label>
                        {!! Form::number('kkm', null, ['class' => 'form-control', 'placeholder' => 'Nilai ketuntasan minimal', 'required']) !!}
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>

    <script>
        $(function() {
            let form = $("#form-jadwal");

            form.validate({
                errorPlacement: function errorPlacement(error, element) { element.before(error); }
            });
            
            form.steps({
                    headerTag:"h3",
                    bodyTag:"fieldset",
                    transitionEffect:"slide",
                    onStepChanging: function(event, currentIndex, newIndex) {

                        if(newIndex == 1) {
                            getMatapelajaran();
                        } else if(newIndex == 2) {
                            getBankSoal();
                        }

                        form.validate().settings.ignore = ":disabled,:hidden";
                        return form.valid();
                    },
                    onFinished: function(event, currentIndex) { 
                        form.submit();
                    }
            });

            $('#matapelajaran_id').change(function() {
                if($(this).val() != null) {
                    getGuru();
                }
            });
        });

        function getGuru() {
            const matapelajaran_id = $('#matapelajaran_id').val();

            if(matapelajaran_id != '') {
                $.ajax({
                    url: "{{ route('guru.findby.matapelajaran') }}",
                    data: {
                        'matapelajaran_id': matapelajaran_id
                    },
                    success: function(result) {
                        let guru = $('#guru_id');

                        guru.empty();

                        guru.append(new Option('Pilih Guru', ''));

                        result.data.forEach((e) => {
                            guru.append(new Option(e.nama, e.id));
                        });
                    }
                })
            }
        }

        function getMatapelajaran() {
            const kelas_id = $('#kelas_id').val();

            if(kelas_id != '') {
                $.ajax({
                    url: "{{ route('matapelajaran.findby.kelas') }}",
                    data: {
                        'kelas_id': kelas_id
                    },
                    success: function(result) {
                        let matapelajaran = $('#matapelajaran_id');

                        matapelajaran.empty();

                        matapelajaran.append(new Option('Pilih Mata Pelajaran', ''));

                        result.forEach((e) => {
                            matapelajaran.append(new Option(e.nama, e.id));
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                })
            }
        }

        function getBankSoal() {
            const matapelajaran_id = $('#matapelajaran_id').val();

            console.log(matapelajaran_id);

            $.ajax({
                    url: "{{ route('banksoal.findby.matapelajaran') }}",
                    data: {
                        'matapelajaran': matapelajaran_id
                    },
                    success: function(result) {
                        let banksoal = $('#bank_soal_id');

                        banksoal.empty();

                        banksoal.append(new Option('Pilih Salah Satu', ''));

                        result.forEach((e) => {
                            banksoal.append(new Option(e.id, e.id));
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                })
        }
    </script>
@endpush