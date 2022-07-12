@extends('layouts.dashboard')
@section('title', 'Tambah Level')
@section('content')
<x-page-title>
    <x-slot name="title">Level</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Level</li>
        <li class="breadcrumb-item active">Buat Level</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Level</h3>
                {!! Form::open(['route' => 'level.store', 'id' => 'form-level']) !!}
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama level', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="skala">Skala 1-3</label>
                    {!! Form::select('skala', $skala, '', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
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
        let form = $('#form-level');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endsection