@extends('layouts.dashboard')
@section('title', 'Edit jadwal')
@section('content')
<x-page-title>
    <x-slot name="title">Jadwal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jadwal</li>
        <li class="breadcrumb-item active">Edit Jadwal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Jadwal</h3>
                {!! Form::model($jadwal, ['route' => ['jadwal.update', $jadwal->id], 'id' => 'form-jadwal']) !!}
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Jadwal</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Mulai</label>
                            {{ Form::input('date', 'tanggal', Carbon\Carbon::parse($jadwal->tanggal)->format('Y-m-d'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="tanggal_expire">Waktu Selesai</label>
                            {!! Form::time('tanggal_expire', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>  
                </div>
                <div class="form-group mt-4">
                    <label for="kelas_id">Pilih Kelas</label>
                    {!! Form::select('kelas_id', $kelas, null, ['class' => 'form-control', 'id' => 'kelas_id', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="matapelajaran_id">Mata Pelajaran</label>
                    {!! Form::select('matapelajaran_id', $matapelajaran, null, ['class' => 'form-control', 'id' => 'matapelajaran_id', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="guru_id">Pilih Guru</label>
                    {!! Form::select('guru_id', $guru, $jadwal->guru_id, ['id' => 'guru_id', 'class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="bank_soal_id">Bank Soal</label>
                    {!! Form::select('bank_soal_id', $banksoal, null, ['class' => 'form-control', 'id' => 'bank_soal_id']) !!}
                </div>
                <div class="form-group">
                    <label for="jenisujian_id">Jenis Ujian</label>
                    {!! Form::select('jenisujian_id', $jenisujian, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="mb-4">
                    <i class="mdi mdi-information-outline"></i>
                    <span class="text-muted text-sm">Bank soal menentukan soal yang akan digunakan pada saat ujian. Dapat dikosongkan apabila belum membuat bank soal</span>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="bobot_pg">Bobot PG (%)</label>
                            {!! Form::number('bobot_pg', $jadwal->penilaian->bobot_pg, ['class' => 'form-control', 'placeholder' => 'Bobot soal PG %']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="bobot_essay">Bobot Essay (%)</label>
                            {!! Form::number('bobot_essay', $jadwal->penilaian->bobot_essay, ['class' => 'form-control', 'placeholder' => 'Bobot soal Essay %']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <label for="kkm">Nilai KKM</label>
                    {!! Form::number('kkm', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="mb-2">
                    <i class="mdi mdi-information-outline"></i>
                    <span class="text-muted text-sm">Dapat dikosongkan salah satu apabila tidak terdapat soal PG ataupun Essay</span>
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
@push('scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        let form = $('#form-jadwal');
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                'nama_kelas': {
                    minlength: 2
                }
            }
        });
        
        let matapelajaran = $('#matapelajaran_id');

        $('#kelas_id').change(function() {
            let kelas_id = $(this).val();
            matapelajaran.empty();
            
            if(kelas_id != '') {
                $.ajax({
                    url: "{{ route('matapelajaran.findby.kelas') }}",
                    data: {
                        'kelas_id': kelas_id
                    },
                    success: function(result) {

                        matapelajaran.append(new Option('Pilih Matapelajaran', ''));
                        
                        result.forEach((e) => {
                            matapelajaran.append(new Option(e.nama, e.id));
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });

            }
        });

        $('#matapelajaran_id').change(function() {
            let matapelajaran = $(this).val();

            if(matapelajaran != '') {
                $.ajax({
                    url: "{{ route('banksoal.findby.matapelajaran') }}",
                    data: {
                        'matapelajaran': matapelajaran
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

            getGuru();

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
    </script>
@endpush