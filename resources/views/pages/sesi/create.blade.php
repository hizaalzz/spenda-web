@extends('layouts.dashboard')
@section('title', 'Sesi')
@section('content')
<x-page-title>
    <x-slot name="title">Sesi</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Sesi</li>
        <li class="breadcrumb-item active">Buat Sesi</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Sesi</h3>
                {!! Form::open(['route' => 'sesi.store', 'id' => 'sesi-form']) !!}
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Sesi', 'required']) !!}
                </div>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-1"></i> Waktu mulai adalah waktu ujian untuk sesi ini dimulai, sedangkan, 
                    waktu selesai adalah waktu ujian untuk sesi ini berakhir
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="start" class="required">Mulai</label>
                            <input type="time" name="start" id="start" class="form-control" placeholder="Waktu Mulai" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="start">Selesai</label>
                            <input type="time" name="end" id="end" class="form-control" placeholder="Waktu Selesai" required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@push('scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        let form = $('#sesi-form');
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endpush