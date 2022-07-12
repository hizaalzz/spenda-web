@extends('layouts.dashboard')
@section('title', 'Penilaian')
@section('css')
    <link rel="stylesheet" href="{{ url('/css/loading.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Nilai</x-slot>
    <x-slot name="item">
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <div>
                        <h3 class="card-title">Nilai</h3>
                        <p class="card-title-desc">Menampilkan nilai dari tiap jadwal</p>
                    </div>
                    <div>
                        <a href="{{ route('export.pdf', $murid->id) }}" class="btn btn-danger btn-sm shadow-sm">
                            <i class="far fa-file-pdf mr-1"></i> Export
                        </a>
                    </div>
                </div>
                <div class="media mb-4 mt-2">
                    <img src="{{ asset('/images/user.svg') }}" class="d-flex mr-3 rounded-circle avatar-sm" alt="">
                    <div class="media-body">
                        <p class="user-title m-0 text-dark">{{ $murid->nama }}</p>
                        <small class="text-muted">
                            {{ $murid->jenis_kelamin === 'L' ? 'Siswa ' : 'Siswi ' }} {{ 'Kelas ' . $murid->kelas->nama_kelas }}
                        </small>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="nilai-table">
                        <thead>
                            <tr>
                                <th>Nama Jadwal</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Nilai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->matapelajaran->nama }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                    <td>
                                        @livewire('compute-score', ['murid' => $murid, 'jadwal' => $item])
                                    </td>
                                    <td>
                                        <a href="{{ route('nilai.edit', [$murid->id, $item->id]) }}" class="btn btn-success btn-sm"
                                            data-toggle="tooltip" data-placement="bottom" title="Edit nilai">
                                            <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <a href="{{ route('jawaban.show', [$murid->id, $item->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Lihat detail jawaban yang benar dan salah">
                                            <i class="mdi mdi-information-outline"></i>
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
            $('#nilai-table').DataTable({
                columnDefs: [
                    { orderable: false, target: 2 }
                ]
            });
        });
    </script>
@endsection