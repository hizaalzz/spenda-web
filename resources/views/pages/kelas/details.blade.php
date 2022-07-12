@extends('layouts.dashboard')
@section('title', 'Detail kelas')
@section('content')
<x-page-title>
    <x-slot name="title">Kelas</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Kelas</li>
        <li class="breadcrumb-item active">Detail kelas</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Kelas {{ $kelas->nama_kelas }}</h3>
                <p class="card-title-desc">Detail Kelas</p>
                <div class="mt-3">
                    <p class="text-muted mb-1">Level</p>
                    <h6>{{ $kelas->level->nama }}</h6>
                </div>
                <hr>
                <div class="mt-3">
                    <p class="text-muted mb-1">Tingkat Kelas</p>
                    <h6>{{ $kelas->jurusan->nama }}</h6>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Murid</h3>
                <p class="card-title-desc mb-2">Murid dari kelas {{ $kelas->nama_kelas }}</p>   
                <div class="table-responsive">
                    <table class="table" id="murid-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas->murid as $muridKelas)
                            <tr>
                                <td>{{ $muridKelas->nama }}</td>
                                <td>{{ $muridKelas->jenis_kelamin }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#murid-table').DataTable({
                columnDefs: [
                    { orderable: true, targets: 1 },
                    { orderable: true, targets: 0 },                
                ]
            });
        });
    </script>
@endsection