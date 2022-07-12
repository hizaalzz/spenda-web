@extends('layouts.dashboard')
@section('title', 'Profil murid')
@section('css')
<style>
    h6 {
        font-weight: 600;
    }

</style>
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Murid</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Murid</li>
        <li class="breadcrumb-item active">Profil</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <div>
                        <h3 class="card-title">Profil Murid</h3>
                        <p class="card-title-desc mb-1">Data lengkap murid</p>
                    </div>
                    @can('update', $murid)
                    <div class="d-flex flex-column">
                        <div class="dropdown mt-4 mt-sm-0">
                            <a href="#" class="btn btn-transparent btn-sm waves-effect" data-toggle="dropdown"><i
                                    class="mdi mdi-18px mdi-dots-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('murid.edit', $murid->id) }}" class="dropdown-item"> Edit murid</a>
                                <a href="#" class="dropdown-item text-danger"
                                    onclick="showModal(`Apakah anda yakin ingin menghapus {{ $murid->nama }} ?`, `#delete-murid`);">Hapus murid</a>
                                {!! Form::open(['route' => ['murid.destroy', $murid->id], 'class' => 'd-none', 'id' => 'delete-murid']) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
                <hr>
                <img src="{{ $murid->foto ? url('/storage/murid/foto') . '/' . $murid->foto : asset('/images/user-no-border.svg') }}"
                alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle" style="object-fit: cover;">
                <div class="mt-3 row">
                    <div class="col">
                        <a href="#" class="text-dark font-weight-medium font-size-16">{{ $murid->nama }}</a>
                        <p class="text-body mt-1 mb-1">Murid</p>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nomor induk siswa nasional (NISN)</p>
                    <h6>{{ $murid->nisn }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nomor induk siswa (NIS)</p>
                    <h6>{{ $murid->nis }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Jenis kelamin</p>
                    <h6>{{ $murid->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Tempat tanggal lahir</p>
                    <h6>{{ $murid->tempat_lahir ?? '' }} {{ $murid->tanggal_lahir }}</h6>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Kelas</p>
                    @if($murid->kelas)
                        <a href="{{ route('class.show', $murid->kelas_id) }}" class="font-weight-bold">{{ $murid->kelas->nama_kelas }}</a>
                    @else 
                        -
                    @endif
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nomor Handphone</p>
                    <h6>{{ $murid->telp ?? 'Tidak ada data' }}</h6>
                </div>

            </div>
        </div>
    </div>
    <x-delete-modal></x-delete-modal>
</div>
@endsection
