@extends('layouts.dashboard')
@section('title', 'Detail Jadwal')
@section('content')
<x-page-title>
    <x-slot name="title">Jadwal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jadwal</li>
        <li class="breadcrumb-item active">Detail Jadwal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-4">
        <h6 class="text-muted">Guru Pengajar</h6>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <img src="{{ asset('/images/user.svg') }}" alt="" width="64" class="rounded">
                    <div class="d-flex flex-column m-auto">
                        <h6>{{ $jadwal->guru->nama }}</h6>
                        <p class="text-muted text-sm m-0">Guru {{ $jadwal->matapelajaran->nama}}</p>
                        <a href="#" class="btn btn-outline-primary btn-sm shadow-sm mt-2">Lihat profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <h6 class="text-muted">Detail Jadwal</h6>
        <div class="card shadow-sm">
            <div class="card-body">
                <div>
                    <p class="text-muted mb-1">Tanggal</p>
                    <h6>{{ $jadwal->tanggal }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nama Jadwal</p>
                    <h6>{{ $jadwal->nama }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nama Kelas</p>
                    <h6>{{ $jadwal->kelas->nama_kelas }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nama Mata Pelajaran</p>
                    <h6>{{ $jadwal->matapelajaran->nama }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nama Guru</p>
                    <h6>{{ $jadwal->guru->nama }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Durasi</p>
                    <h6>{{ $jadwal->durasi . ' Menit'}}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Tanggal Expire</p>
                    <h6>{{ $jadwal->tanggal_expire }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection