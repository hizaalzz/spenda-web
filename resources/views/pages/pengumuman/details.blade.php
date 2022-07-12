@extends('layouts.dashboard')
@section('title', 'pengumuman')
@section('content')
<x-page-title>
    <x-slot name="title">Pengumuman</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Pengumuman</li>
        <li class="breadcrumb-item active">Detail Pengumuman</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Pengumuman</h3>
                <h2 class="mt-4">{{ $pengumuman->judul }}</h2>
                {!! $pengumuman->konten !!}
            </div>
        </div>
    </div>
</div>
@endsection