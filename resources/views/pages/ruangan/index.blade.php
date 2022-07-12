@extends('layouts.dashboard')
@section('title', 'Ruangan')
@section('content')
<x-page-title>
    <x-slot name="title">Ruangan</x-slot>
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
    <x-slot name="title">Buat Ruangan baru</x-slot>
    <x-slot name="content">
        {!! Form::open(['route' => 'ruangan.store', 'id' => 'createForm']) !!}
        @csrf
        <label for="nama">Nama Ruangan</label>
        {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Ruangan', 'required']) !!}
        {!! Form::close() !!}
    </x-slot>
</x-form-modal>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>

    <script>
        let form = $('#createForm');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        });
    </script>

    {{ $dataTable->scripts() }}
@endpush