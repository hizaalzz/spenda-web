@extends('layouts.dashboard')
@section('title', 'Detail Jawaban')
@section('content')
<x-page-title>
    <x-slot name="title">Nilai</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Nilai</li>
        <li class="breadcrumb-item active">Detail Nilai</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Jawaban {{ $murid->nama }}</h3>
                <p class="card-title-desc">Detail jawaban {{ $jadwal->nama . ' ' . $jadwal->matapelajaran->nama }}</p>
                <div class="table-responsive">
                    <table class="table" id="jawaban-table">
                        <thead>
                            <tr>
                                <th>Nomor Soal</th>
                                <th>Isi Soal</th>
                                <th>Kunci Jawaban</th>
                                <th>Jawaban</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jawaban as $item)
                                <tr>
                                    <td>{{ $item->soal->nomor_soal }}</td>
                                    <td class="konten">
                                        <a href="#" onclick="showDetailSoal({{ $item->soal_id }})">{!! strip_tags($item->soal->isi) !!}</a>
                                    </td>
                                    <td>{{ $item->soal->kunci_jawaban }}</td>
                                    <td>{{ $item->jawaban }}</td>
                                    <td>
                                        @if($item->status === 'Benar')
                                            <i class="mdi mdi-check-circle-outline" style="color:green;"></i> Benar
                                        @elseif($item->status === 'Salah')
                                            <i class="mdi mdi-window-close" style="color:red;"></i> Salah

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <h5>Nilai Akhir : {{ $nilai->nilai ?? '-' }}</h5>
                </div>
            </div>
        </div>
    </div>
    @include('components.jawaban-modal')
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#jawaban-table').DataTable();
        });
    </script>
@endsection