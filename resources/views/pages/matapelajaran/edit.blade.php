@extends('layouts.dashboard')
@section('title', 'Edit mata pelajaran')
@section('content')
<x-page-title>
    <x-slot name="title">Mata Pelajaran</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Mata Pelajaran</li>
        <li class="breadcrumb-item active">Edit Mata Pelajaran</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Mata Pelajaran</h3>
                {!! Form::model($matapelajaran, ['route' => ['matapelajaran.update', $matapelajaran->id], 'id' => 'form-matapelajaran']) !!}
                @method('PUT')
                <div class="form-group">
                    {!! Form::text('nama', null, ['class' => 'form-control', 'required']) !!}
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
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>

    <script>
        let form = $('#form-matapelajaran');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endsection