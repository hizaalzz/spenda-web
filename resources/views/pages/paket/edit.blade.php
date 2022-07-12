@extends('layouts.dashboard')
@section('title', 'Edit Paket Soal')
@section('content')
<x-page-title>
    <x-slot name="title">Paket</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Paket</li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Paket Soal {{ $paket->kode_soal }}</h3>
                {!! Form::model($paket, ['route' => ['paket.update', $paket->id], 'id' => 'form-paket']) !!}
                @method('PUT')
                <div class="form-group mt-4">
                    <label for="nama_paket">Nama Paket</label>
                    {!! Form::text('kode_soal', null, ['class' => 'form-control', 'placeholder' => 'Nama paket soal', 'required']) !!}
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
<x-delete-modal></x-delete-modal>
@endsection
@section('js')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>

    <script>
        let form = $('#form-paket');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        });

        $(document).ready(function() {
            $('#jadwalTable').DataTable();
        });
    </script>
@endsection