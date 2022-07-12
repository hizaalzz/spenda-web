@extends('layouts.test')
@section('title', 'Akun Ujian Murid')
@section('content')
<div class="flex flex-col items-center">
    <div id="nav" class="flex self-start ml-4 mt-4 text-sm">
        <a href="{{ route('ujian.persiapan') }}" class="text-blue-500 float-left">Dashboard</a>
        <span class="mx-3">/</span>
        <span>Detail Akun</span>
    </div>
    <div class="card">
        <h3 class="text-blue-500 text-xl mt-4 mx-4">Detail Akun</h3>
        <div class="p-4 md:p-6 lg:p-6">
            <div class="flex mb-4">
                <img src="{{ $murid->foto ? url('/storage/murid/foto') . '/' . $murid->foto : asset('/images/user2.svg') }}" alt=""
                class="w-10 h-10 rounded-full object-cover">
                <div class="ml-2 my-auto">
                    <p>{{ auth()->user()->nama }}</p>
                    <p class="text-xs text-gray-600">{{ $murid->jenis_kelamin === 'L' ? 'Siswa ' : 'Siswi ' }}
                        @if($murid->kelas)
                        {{ 'Kelas : ' . $murid->kelas->nama_kelas }}
                        @endif
                </div>
            </div>
            <div class="my-3 py-2">
                <p class="text-xs text-gray-500">NISN / NIS</p>
                <p>{{ $murid->nisn . ' / ' . $murid->nis }}</p>
            </div>
            <hr>
            <div class="my-3 py-2">
                <p class="text-xs text-gray-500">Jenis Kelamin</p>
                <p>{{ $murid->jenis_kelamin }}</p>
            </div>
            <hr>
            <div class="my-3 py-2">
                <p class="text-xs text-gray-500">Tempat Tanggal Lahir</p>
                <p>{{ $murid->tempat_lahir . ', ' . $murid->tanggal_lahir  }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
