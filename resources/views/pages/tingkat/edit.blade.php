@extends('layouts.dashboard')
@section('title', 'Tambah jurusan')
@section('css')
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.4/r-2.2.6/datatables.min.css" />
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Jurusan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jurusan</li>
        <li class="breadcrumb-item active">List Jurusan</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Data Jurusan</h3>
                <p class="card-title-desc">Isi form dibawah untuk menambahkan</p>
                {!! Form::model($jurusan, ['route' => ['jurusan.update', $jurusan->id], 'id' => 'form-jurusan']) !!}
                @csrf
                <div class="form-group">
                    <label for="nama">Kode Tingkat Kelas</label>
                    {!! Form::text('kode_tingkat', null, ['class' => 'form-control', 'placeholder' => 'Tingkat Kelas',
                    'required']) !!}
                </div>
                <div class="form-group">
                    <label for="nama">Nama Jurusan</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama jurusan',
                    'required']) !!}
                </div>
                <br>
                <div class="text-center mt-2">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title mt-2">Hapus Mata Pelajaran</h3>
                <p class="card-title-desc">Hapus mata pelajaran dari jurusan {{ $jurusan->nama }}</p>
                <div class="table-responsive">
                    <table class="table" id="pelajaran">
                        <thead>
                            <th>Nama</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($jurusan->matapelajaran as $pelajaran)
                            <tr>
                                <td>{{ $pelajaran->nama }}</td>
                                <td>
                                    {!! Form::open(['route' => ['matapelajaran.delete', $jurusan->id]]) !!}
                                    {!! Form::hidden('matapelajaran_id', $pelajaran->id) !!}
                                    {{ Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title mt-2">Tambah Mata Pelajaran</h3>
                <p class="card-title-desc">Pilih mata pelajaran untuk jurusan {{ $jurusan->nama }}</p>
                {!! Form::open(['route' => ['matapelajaran.add', $jurusan->id]]) !!}
                <div class="table-responsive">
                    <table class="table" id="matapelajaran">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($matapelajaran as $m)
                                @if(ArrayHelp::searchMultiDimension($m->nama, $jurusan->matapelajaran->toArray()))
                                    <tr>
                                        <td>{!! Form::checkbox('matapelajaran[]', $m->id, false) !!}</td>
                                        <td>{{ $m->nama }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#matapelajaran').DataTable({
            columnDefs: [{
                    orderable: true,
                    targets: 1
                },
                {
                    orderable: false,
                    targets: 0
                }
            ]
        });

        $('#pelajaran').DataTable();
    });

    let form = $('#form-jurusan');

    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); }
    })

</script>
@endpush
