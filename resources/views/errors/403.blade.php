@extends('layouts.errors')
@section('title', 'Halaman tidak ditemukan')
@section('content')
<div class="card overflow-hidden">
    <div class="card-body">
        <div class="text-center p-3">
            <div class="img">
                <img src="{{ asset('/images/403.svg') }}" class="img-fluid" alt="">
            </div>

            <h1 class="error-page mt-5"><span>403!</span></h1>
            <h4 class="mb-4 mt-5">Akses tidak di izinkan</h4>
            <a class="btn btn-primary mb-4 waves-effect waves-light" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home"></i> Kembali ke dashboard
            </a>
        </div>
    </div>
</div>
@endsection
