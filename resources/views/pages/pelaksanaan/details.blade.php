@extends('layouts.dashboard')
@section('title', 'Detail Pelaksanaan')
@section('css')
    <link rel="stylesheet" href="{{ asset('libs/select2/css/select2.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Pelaksanaan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Pelaksanaan</li>
        <li class="breadcrumb-item active">Detail Pelaksanaan</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
           <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Pelaksanaan</h3>
                    <a href="{{ route('pelaksanaan.create', $kelas->id) }}" class="btn btn-success btn-sm">
                        <span class="font-weight-bold"><i class="fas fa-plus"></i> Tambah</span>
                    </a>
                </div>
                <p class="card-title-desc">Atur murid yang dapat melaksanakan ujian pada kelas {{ $kelas->nama_kelas }}</p>
                <div class="d-flex justify-content-between mb-4">
                    <label for="jadwal-select">Filter jadwal</label>
                    <select name="jadwal" id="jadwal-select">
                        <option value="0">Semua jadwal</option>
                        @foreach($jadwal as $item)
                            <option value="{{ $item->id }}" @if(request()->query('jadwal') == $item->id) selected="selected" @endif>
                                {{ $item->matapelajaran->nama . ' - ' . $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table" id="pelaksanaan-table">
                        <thead>
                            <tr>
                                <th>Nama Murid</th>
                                <th>Jadwal</th>
                                <th>Ruangan</th>
                                <th>Sesi</th>
                                <th>Paket</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelaksanaan as $item)
                                <tr>
                                    <td>{{ $item->murid->nama }}</td>
                                    <td>{{ $item->jadwal->nama . ' - ' . $item->jadwal->matapelajaran->nama }}</td>
                                    <td>{{ $item->ruangan->nama }}</td>
                                    <td>{{ $item->sesi->nama }}</td>
                                    <td>{{ $item->paket->kode_soal }}</td>
                                    <td>
                                        <div class='d-flex'>
                                            <a href="{{ route('pelaksanaan.edit', $item->id) }}" class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                                            
                                            <form action="{{ route('pelaksanaan.destroy', $item->id) }}" class="ml-1 delete-form" data-target="{{ $item->id }}" method='POST'>
                                                @csrf
                                                <input type='hidden' name='_method' value='delete'>
                                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                                <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus pelaksanaan ini?`, `.delete-form`, `{{ $item->id }}`);'>
                                                    <i class='fas fa-trash'></i>
                                                </button>
                                            </form>
                                        </div>
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
<x-delete-modal></x-delete-modal>
@endsection
@section('js')
<script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#pelaksanaan-table').DataTable();
        $('#jadwal-select').select2();

        $('#jadwal-select').change(function() {
            const kelas = "{{ $kelas->id }}";
            let url = null;

            if($(this).val() == 0) {
                url = "{{ url('/pelaksanaan/kelas/') }}" + `/${kelas}`;
            } else {
                url = "{{ url('/pelaksanaan/kelas/') }}" + `/${kelas}?jadwal=${$(this).val()}`;
            }   

            window.location.href = url;
        });
    });
</script>
@endsection