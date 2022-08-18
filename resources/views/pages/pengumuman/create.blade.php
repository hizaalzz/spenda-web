@extends('layouts.dashboard')
@section('title', 'Pengumuman')
@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Pengumuman</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Pengumuman</li>
        <li class="breadcrumb-item active">Buat Pengumuman</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Pengumuman</h3>
                <p class="card-title-desc">Buat pengumuman baru</p>
                {!! Form::open(['route' => 'pengumuman.store', 'id' => 'pengumuman-form']) !!}
                @csrf
                <div class="form-group">
                    <label for="judul">Judul</label>
                    {!! Form::text('judul', null, ['class' => 'form-control', 'placeholder' => 'Judul pengumuman', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="konten">Isi / Konten</label>
                    {!! Form::textarea('konten', null, ['class' => 'summernote text-black']) !!}
                </div>
                <div class="form-group">
                    <label for="jenis">Pengumuman untuk</label>
                    {!! Form::select('jenis', ['' => 'Pilih Peruntukkan', 'guru' => 'Guru', 'murid' => 'Murid', 'keduanya' => 'Keduanya'], '', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@push('scripts')
    <script src="{{ asset('/vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({height:300,minHeight:null,maxHeight:null,focus:!0});
        });

        let form = $('#pengumuman-form');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endpush