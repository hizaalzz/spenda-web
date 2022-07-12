@extends('layouts.dashboard')
@section('title', 'Detail Jurusan')
@section('content')
<x-page-title>
    <x-slot name="title">Jurusan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jurusan</li>
        <li class="breadcrumb-item active">Detail</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Detail Jurusan</h3>
                <p class="card-title-desc">Jurusan {{ $jurusan->nama }}</p>

                <div class="mt-3">
                    <p class="text-muted mb-1">Kode Tingkat Kelas</p>
                    <h6>{{ $jurusan->kode_tingkat }}</h6>
                </div>
                <hr>
                <div class="mt-3">
                    <p class="text-muted mb-1">Nama Tingkat Kelas</p>
                    <h6>{{ $jurusan->nama }}</h6>
                </div>
                <hr>
                <span class="text-dark font-weight-bold">Mata Pelajaran</span>
                <div class="table-responsive mt-3">
                    <table class="table" id="matapelajaran-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurusan->matapelajaran as $matapelajaran)
                                <tr>
                                    <td>{{ $matapelajaran->nama }}</td>
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
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.4/r-2.2.6/datatables.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#matapelajaran-table').DataTable();
        });
    </script>
@endpush