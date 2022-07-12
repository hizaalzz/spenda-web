@extends('layouts.dashboard')
@section('title', 'Import Data')
@section('content')
<x-page-title>
    <x-slot name="title">Import data</x-slot>
    <x-slot name="item">
    </x-slot>
</x-page-title>
@include('messages.alert')
<div class="alert alert-warning alert-dismissible">
    <i class="fas fa-exclamation-triangle mr-1"></i> File yang didukung <strong>(.xls, .xlsx, .csv)</strong> 
</div>
<div class="d-flex flex-wrap">
    <div class="col">
        <div class="card rounded-sm">
            <div class="card-header bg-danger">
                <h3 style="color:white;">Import data Guru</h3>
            </div>
            <div class="card-body">
                <p class="card-title-desc">Import data guru dari penyimpanan lokal</p>
                <span class="mt-4 text-black">
                    File yang diimport harus memiliki format dan model yang sesuai
                    <a href="{{ asset('/documents/guruformat.xlsx') }}">Download contoh format atau model file</a>
                </span>
                <div class="form-group mt-4">
                    {!! Form::open(['route' => 'import.store', 'enctype' => 'multipart/form-data']) !!}
                    {!! Form::hidden('type', 'Guru') !!}
                    <div class="form-group">
                        <label for="data">Pilih file</label><br>
                        {!! Form::file('data', ['accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel', 
                        'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="text-center">
                        {{ Form::button('<i class="fas fa-check"></i> Upload', ['type' => 'submit', 'class' => 'btn btn-success']) }}
                    </div>
                    {!! Form::close() !!}
                </div> 
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-sm">
            <div class="card-header bg-primary">
                <h3 style="color:white;">Import data Murid</h3>
            </div>
            <div class="card-body">
                <p class="card-title-desc">Import data murid dari penyimpanan lokal</p>
                <span class="mt-4 text-black">
                    File yang diimport harus memiliki format dan model yang sesuai
                    <a href="{{ asset('/documents/muridformat.xlsx') }}">Download contoh format atau model file</a>
                </span>
                <div class="form-group mt-4">
                    {!! Form::open(['route' => 'import.store', 'enctype' => 'multipart/form-data']) !!}
                    {!! Form::hidden('type', 'Murid') !!}
                    <div class="form-group">
                        <label for="data">Pilih file</label><br>
                        {!! Form::file('data', ['accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel', 
                        'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="text-center">
                        {{ Form::button('<i class="fas fa-check"></i> Upload', ['type' => 'submit', 'class' => 'btn btn-success']) }}
                    </div>
                    {!! Form::close() !!}
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection