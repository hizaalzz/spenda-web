@extends('layouts.dashboard')
@section('title', 'Pilih Jadwal')
@section('content')
<x-page-title>
    <x-slot name="title">Konten</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Konten</li>
        <li class="breadcrumb-item active">List Jadwal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="card-title">Konten</h3>
                        <p class="card-title-desc">Pilih jadwal untuk menampilkan konten</p>
                    </div>
                    <a href="{{ route('konten.create') }}" class="btn btn-success btn-sm align-self-start">Buat konten</a>
                </div>
                <div class="table-responsive"> 
                    <table class="table" id="jadwal-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->matapelajaran->nama }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                    <td>
                                        <a href="{{ route('konten.index', ['jadwal' => $item->id]) }}" class="btn btn-primary btn-sm">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#jadwal-table').DataTable();
        });
    </script>
@endsection