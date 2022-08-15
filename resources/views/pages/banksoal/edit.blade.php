@extends('layouts.dashboard')
@section('title', 'Edit Bank Soal')
@section('content')
<x-page-title>
    <x-slot name="title">Bank Soal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Bank Soal</li>
        <li class="breadcrumb-item active">Edit Bank Soal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Bank Soal</h3>
                {!! Form::model($banksoal, ['route' => ['banksoal.update', $banksoal->id]]) !!}
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="matapelajaran_id">Mata Pelajaran</label>
                            {!! Form::select('matapelajaran_id', $matapelajaran, null, ['class' => 'form-control', 'id' => 'matapelajaran_id', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="level_id">Level soal</label>
                            {!! Form::select('level_id', $level, null, ['class' => 'form-control', 'required']) !!}
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jurusan_id">Tingkat Kelas</label>
                    {!! Form::select('jurusan_id', $jurusan, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="tahun">Tahun Soal <small class="text-danger"></small></label>
                            {!! Form::text('tahun', null, ['class' => 'form-control', 'placeholder' => 'Tahun Soal', 'required']) !!}
                        </div>
                    </div>
                </div>
                @if(auth()->user()->hasRole('admin'))
                    <div class="form-group">
                        <label for="guru_id">Guru</label>
                        {!! Form::select('guru_id', $guru, null, ['class' => 'form-control', 'id' => 'guru_id', 'required']) !!}
                    </div>
                @else 
                    {!! Form::hidden('guru_id', $guru->id) !!}
                @endif
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="opsi_pg">Opsi Pilihan Ganda</label>
                            {!! Form::select('opsi_pg', [2 => 'A-B', 3 => 'A-C', 4 => 'A-D'], 3, ['class' => 'form-control', 'required']) !!}
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
        });

    </script>
@endpush