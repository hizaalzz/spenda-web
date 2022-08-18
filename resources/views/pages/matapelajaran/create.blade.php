@extends('layouts.dashboard')
@section('title', 'Edit mata pelajaran')
@section('content')
<x-page-title>
    <x-slot name="title">Mata Pelajaran</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Mata Pelajaran</li>
        <li class="breadcrumb-item active">Tambah Mata Pelajaran</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Mata Pelajaran</h3>
                {!! Form::open(['route' => 'matapelajaran.store']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::text('nama', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Nama mata pelajaran', 'required']) !!}
                </div>
                <div class="form-group">
                    <div class="text-center">
                        {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    </div>
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
        $(document).ready(function() {
            $('#guru-table').DataTable();
        }); 

        let form = $('#form-matapelajaran');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endsection