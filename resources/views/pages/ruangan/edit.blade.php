@extends('layouts.dashboard')
@section('title', 'Edit Ruangan')
@section('content')
<x-page-title>
    <x-slot name="title">Ruangan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Ruangan</li>
        <li class="breadcrumb-item active">Edit Ruangan</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Ruangan</h3>
                <p class="card-title-desc">Ruangan {{ $ruangan->nama }}</p>
                {!! Form::model($ruangan, ['route' => ['ruangan.update', $ruangan->id], 'id' => 'form-ruangan']) !!}
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Ruangan</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'required']) !!}
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
        let form = $('#form-ruangan');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endsection