@extends('layouts.dashboard')
@section('title', 'Tambah Bank Soal')
@section('content')
<x-page-title>
    <x-slot name="title">Bank Soal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Bank Soal</li>
        <li class="breadcrumb-item active">Tambah Bank Soal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Bank Soal</h3>
                <p class="card-title-desc">Buat bank soal baru</p>
                {!! Form::open(['route' => 'banksoal.store', 'id' => 'createForm', 'class' => 'outer-repeater']) !!}
                @csrf
                <div class="form-group">
                    <label for="jurusan_id">Tingkat Kelas</label>
                    {!! Form::select('jurusan_id', $jurusan, null, ['class' => 'form-control', 'id' => 'jurusan_id', 'required']) !!}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="matapelajaran_id">Mata Pelajaran</label>
                            {!! Form::select('matapelajaran_id', ['' => 'Pilih tingkat kelas terlebih dahulu'], null, ['class' => 'form-control', 'id' => 'matapelajaran_id', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="level_id">Level soal</label>
                            {!! Form::select('level_id', $level, null, ['class' => 'form-control', 'required']) !!}
                         </div>
                    </div>
                </div>
                @if(auth()->user()->hasRole('admin'))
                    <div class="form-group">
                        <label for="guru_id">Guru</label>
                        {!! Form::select('guru_id', ['' => 'Pilih Mata Pelajaran Terlebih Dahulu'], null, ['class' => 'form-control', 'id' => 'guru_id', 'required']) !!}
                    </div>
                @else 
                    {!! Form::hidden('guru_id', $guru->id) !!}
                @endif
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="opsi_pg">Opsi Pilihan Ganda</label>
                            {!! Form::select('opsi_pg', [2 => 'A-B', 3 => 'A-C', 4 => 'A-D', 5 => 'A-E'], 3, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="status">Status</label>
                            {!! Form::select('status', ['Aktif' => 'Aktif', 'Nonaktif' => 'Nonaktif'], null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#matapelajaran').DataTable({
                columnDefs: [
                    { orderable: true, targets: 1 },
                    { orderable: false, targets: 0 }
                ]
            });
        });

        let form = $('#createForm');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })

        $("#matapelajaran_id").on('change', function() {
            const value = $(this).val();

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
        });

        $("#jurusan_id").on('change', function() {
            const value = $(this).val();

            $.ajax({
                method: 'GET',
                url: "{{ route('matapelajaran.findby.jurusan') }}",
                data: {
                    jurusan: value
                }, 
                success: function(data) {
                    applyData(data, '#matapelajaran_id');
                }, 
                error: function(xhr) {
                    let error = JSON.parse(xhr.responseText);

                    console.error(error.message);
                }
            });
        });


        function applyData(result, selector, propertyName = null) {
            let selectForm = $(selector);

            selectForm.empty();

            selectForm.append(new Option('Pilih Salah Satu', ''));

            result.forEach((e) => {
                selectForm.append(new Option(e.propertyName ?? e.nama, e.id));
            });
        }
    </script>
@endpush