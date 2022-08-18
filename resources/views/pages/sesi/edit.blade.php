@extends('layouts.dashboard')
@section('title', 'Sesi')
@section('content')
<x-page-title>
    <x-slot name="title">Sesi</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Sesi</li>
        <li class="breadcrumb-item active">Edit Sesi</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Sesi</h3>
                {!! Form::model($sesi, ['route' => ['sesi.update', $sesi->id]]) !!}
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Sesi', 'required']) !!}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="start">Mulai</label>
                            <input type="time" name="start" id="start" class="form-control" placeholder="Waktu Mulai" value="{{ $sesi->start }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="start">Selesai</label>
                            <input type="time" name="end" id="end" class="form-control" placeholder="Waktu Selesai" value="{{ $sesi->end }}" required>
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