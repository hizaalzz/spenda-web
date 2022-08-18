@extends('layouts.dashboard')
@section('title', 'Upload Soal')
@section('content')
<x-page-title>
    <x-slot name="title">Upload Soal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Soal</li>
        <li class="breadcrumb-item active">Upload</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Form Upload Soal</h3>
                <p class="card-title-desc">Upload soal ujian untuk mata pelajaran tertentu</p>
                <div class="inline-block my-4">
                    <span>Format file soal </span> 
                    <a href="{{ asset('/documents/soalformat.xlsx') }}">Download format file soal</a>
                </div>
                {!! Form::open(['route' => 'upload.soal', 'enctype' => 'multipart/form-data', 'id' => 'form-soal']) !!}
                {!! Form::hidden('bank_soal_id', $banksoal->id) !!}
                <div class="form-group">
                    <label for="paket_id">Paket soal</label>
                    {!! Form::select('paket_id', $paket, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="data">File</label>
                    {!! Form::file('data', ['accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel', 'class' => 'form-control']) !!}
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
        let form = $('#form-soal');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        });
    </script>
@endsection