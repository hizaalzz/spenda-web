@extends('layouts.dashboard')
@section('title', 'Profil Guru')
@section('css')
    <style>
        h6 {
            font-weight: 600;
        }
    </style>
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Guru</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Guru</li>
        <li class="breadcrumb-item active">Profil</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-md-12 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <div class="">
                        <img src="{{ $guru->foto ? url('/storage/guru/foto') . '/' . $guru->foto : asset('/images/user-no-border.svg') }}"
                        alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle" style="object-fit: cover;">
                    </div>
                    <div class="mt-3 mb-3">
                        <a href="#" class="text-dark font-weight-medium font-size-16">{{ $guru->nama }}</a>
                        <p class="text-body mt-1 mb-1">Guru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4>Data Guru</h4>
                    <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-success btn-sm shadow-sm my-auto">
                        <i class="fas fa-pencil-alt"></i> Edit profil
                    </a>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">NUPTK</p>
                    <h6>{{ $guru->nuptk ?? '-' }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Email</p>
                    <h6>{{ $guru->email }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Jenis Kelamin</p>
                    <h6>{{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Tempat Tanggal lahir</p>
                    <h6>{{ $guru->tempat_lahir ?? '' }} {{ $guru->tanggal_lahir }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nomor Handphone</p>
                    <h6>{{ $guru->telp ?? 'Tidak ada data' }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
