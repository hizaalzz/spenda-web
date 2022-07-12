@extends('layouts.dashboard')
@section('title', 'Penilaian')
@section('content')
<x-page-title>
    <x-slot name="title">Penilaian</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Penilaian</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Penilaian Kelas {{ $kelas->nama_kelas }}</h3>
                <div class="table-responsive">
                    <table class="table" id="murid-table">
                        <thead>
                            <tr>
                                <th>Murid</th>
                                <th>Jenis Kelamin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas->murid as $murid)
                            <tr>
                                <td>{{ $murid->nama }}</td>
                                <td>{{ $murid->jenis_kelamin }}</td>
                                <td>
                                    <a href="{{ route('nilai.show', $murid->id) }}" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-eye"></i>
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
            $('#murid-table').DataTable({
                columnDefs: [
                    { orderable: false, target: 2 }
                ]
            });
        });
    </script>
@endsection