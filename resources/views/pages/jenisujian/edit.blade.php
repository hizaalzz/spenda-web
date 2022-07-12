@extends('layouts.dashboard')
@section('title', 'Jenis Ujian')
@section('content')
<x-page-title>
    <x-slot name="title">Jenis Ujian</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jenis Ujian</li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Jenis Ujian</h3>
                {!! Form::model($jenisujian, ['route' => ['jenisujian.update', $jenisujian->id], 'id' => 'jenisujian-form']) !!}
                @method('PUT')
                <div class="form-group">
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama jenis ujian', 'required']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@push('scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        let form = $('#jenisujian-form');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endpush