@extends('layouts.dashboard')
@section('title', 'Konten')
@section('content')
<x-page-title>
    <x-slot name="title">Konten</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Konten</li>
        <li class="breadcrumb-item active">List Konten</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <h3 class="card-title">Konten / Media</h3>
                        <p class="card-title-desc">Menampilkan konten atau media pada soal</p>
                    </div>
                    <a href="{{ route('konten.create', ['soal' => $soal->id]) }}" class="btn btn-success btn-sm align-self-start">
                        <i class="fas fa-cloud-upload-alt"></i>  Upload konten / media
                    </a>
                </div>
                <div class="faq-box media mb-4">
                    <div class="faq-icon mr-3">
                        <i class="bx bx-info-circle font-size-20 text-info"></i>
                    </div>
                    <div class="media-body">
                        <h5 class="font-size-15">Nomor Soal</h5>
                        <p class="text-muted">{{ $soal->nomor_soal ?? '' }}</p>
                    </div>
                </div>
                <div class="faq-box media mb-4">
                    <div class="faq-icon mr-3">
                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                    </div>
                    <div class="media-body">
                        <h5 class="font-size-15">Isi soal</h5>
                        <p class="text-muted">{{ strip_tags($soal->isi) }}</p>
                    </div>
                </div>
                <h5 class="font-size-15 font-weight-bold">Konten/Media</h5>
                <div class="table-responsive"> 
                    <table class="table" id="konten-table">
                        <thead>
                            <tr>
                               <th>Isi</th>
                               <th>Type</th>
                               <th>Layout</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soal->konten as $item)
                                <tr>
                                    <td>
                                        @if($item->type == 'image') 
                                            <img src="{{ url('/storage/images/soal/') . '/' . $item->isi }}" alt="" width="128">
                                        @elseif($item->type == 'audio') 
                                            <audio controls>
                                                <source src="{{ url('/storage/audio/') . '/' . $item->isi }}">
                                                Browser anda tidak mendukung audio
                                            </audio>
                                        @endif
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->layout }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['konten.destroy', $item->id], 'data-target' => $item->id, 'class' => 'delete-form']) !!}
                                        @method('DELETE')
                                        <a href="#" class="btn btn-danger btn-sm" onclick="showModal(`Apakah anda yakin ingin menghapus konten ini {{ $item->type }}?`, `.delete-form`, `{{ $item->id }}`);">
                                            <i class='fas fa-trash'></i>
                                        </a>
                                        {!! Form::close() !!}
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
    <script>
        $(document).ready(function() {
            $('#konten-table').DataTable();
        });
    </script>
@endsection