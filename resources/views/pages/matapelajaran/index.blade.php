@extends('layouts.dashboard')
@section('title', 'Mata Pelajaran')
@section('content')
<x-page-title>
    <x-slot name="title">Mata Pelajaran</x-slot>
    <x-slot name="item">
       
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive"> 
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
<x-form-modal modalName="createModal" formName="createForm">
    <x-slot name="title">Buat Mata Pelajaran baru</x-slot>
    <x-slot name="content">
        {!! Form::open(['route' => 'matapelajaran.store', 'id' => 'createForm']) !!}
        @csrf
        <div class="form-group">
            <label for="nama">Mata Pelajaran</label>
            {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama mata pelajaran', 'autocomplete' => 'off', 'required']) !!}
        </div>
        <div class="form-group">
            <label for="durasi">Durasi</label>
            {!! Form::number('durasi', null, ['class' => 'form-control', 'placeholder' => 'Durasi pelajaran', 'required']) !!}
        </div>
        {!! Form::close() !!}
    </x-slot>
</x-form-modal>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>


    {{ $dataTable->scripts() }}
@endpush