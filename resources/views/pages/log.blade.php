@extends('layouts.dashboard')
@section('title', 'Log Aktifitas')
@section('content')
<x-page-title>
    <x-slot name="title">Log Aktifitas</x-slot>
    <x-slot name="item">
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                    </div>
                    @if(auth()->user()->can('hapus-log'))
                        {!! Form::open(['route' => 'log.destroy', 'class' => 'd-none delete-form', 'data-target' => 'all']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {{ Form::button("<i class='fas fa-trash'></i> Hapus semua log", ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                        {!! Form::close() !!}
                        <button type="button" class="btn btn-danger btn-sm my-auto" 
                        onclick="showModal('Apakah anda yakin ingin menghapus semua catatan aktivitas?', `.delete-form`, 'all');">
                            <i class="fas fa-trash"></i> Hapus semua log
                        </button>
                    @endif
                </div>
                <div class="alert alert-danger mb-4">
                    <i class="mdi mdi-information-outline"></i>
                    <span>Tiap log aktivitas akan otomatis terhapus dalam waktu 30Hari</span>
                </div>
                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    {{ $dataTable->scripts() }}
@endpush