@extends('layouts.dashboard')
@section('title', 'Edit Jadwal Pelaksanaan')
@section('content')
<x-page-title>
    <x-slot name="title">Pelaksanaan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Pelaksanaan</li>
        <li class="breadcrumb-item active">Edit Pelaksanaan</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Form Jadwal Pelaksanaan</h3>
                <p class="card-title-desc">Edit jadwal pelaksanaan</p>
                <div class="form-group">
                    <label for="nama_murid">Nama Murid</label>
                    <p class="text-dark font-weight-bold">{{ $pelaksanaan->murid->nama }}</p>
                </div>
                {!! Form::model($pelaksanaan, ['route' => ['pelaksanaan.update', $pelaksanaan->id]]) !!}
                @method('PUT')
                {!! Form::hidden('kelas_id', $pelaksanaan->murid->kelas_id) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="sesi_id">Sesi</label>
                            {!! Form::select('sesi_id', $sesi, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="paket_id">Paket Soal</label>
                            {!! Form::select('paket_id', $paket, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ruangan_id">Ruangan</label>
                    {!! Form::select('ruangan_id', $ruangan, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#muridTable').DataTable({
                order: [[1, 'asc']],
                pageLength: 50,
                columnDefs: [{
                    targets:0, orderable:false, width: "5%"
                }]
            });
        })
    </script>
@endsection