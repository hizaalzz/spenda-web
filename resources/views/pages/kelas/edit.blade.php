@extends('layouts.dashboard')
@section('title', 'Edit Kelas')
@section('content')
<x-page-title>
    <x-slot name="title">Kelas</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Kelas</li>
        <li class="breadcrumb-item active">Edit kelas</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Kelas {{ $kelas->nama_kelas }}</h3>
                {!! Form::model($kelas, ['route' => ['class.update', $kelas->id], 'id' => 'form-kelas']) !!}
                @method('PUT')
                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    {!! Form::text('nama_kelas', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nama Kelas']) !!}
                </div>
                <div class="form-group">
                    <label for="level_id">Level Kelas</label>
                    {!! Form::select('level_id', $level, $kelas->level_id, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="jurusan_id">Jurusan</label>
                    {!! Form::select('jurusan_id', $jurusan, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary mt-2']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Hapus Murid</h3>
                <p class="card-title-desc mb-2">Hapus murid dari kelas {{ $kelas->nama_kelas }}</p>
                {!! Form::open(['route' => ['murid.delete', $kelas->id]]) !!}
                <div class="d-flex mb-4">
                    {{ Form::button('<i class="fas fa-trash"></i> Hapus yang dipilih', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                </div>
                <div class="table-responsive">
                    <table class="table" id="hapus-murid-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas->murid as $muridKelas)
                            <tr>
                                <td>{!! Form::checkbox('murid_id[]', $muridKelas->id, false) !!}</td>
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
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Tambah Murid</h3>
                <p class="card-title-desc">Pilih murid untuk kelas {{ $kelas->nama_kelas }}</p>
                {!! Form::open(['route' => ['murid.add', $kelas->id]]) !!}
                <div class="table-responsive">
                    <table class="table" id="murid-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($murid as $item)
                                <tr>
                                    <td>
                                        {!! Form::checkbox('murid_id[]', $item->id, false) !!}
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
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
        let form = $('#form-kelas');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                'nama_kelas': {
                    minlength: 2
                }
            }
        })

        $('#btn-acak').click(function() {
            let checkbox = $("input[name='murid[]']");

            let random = Math.floor(Math.random() * checkbox.length);
            checkbox[random].checked = true;
        });

        $(document).ready(function() {
            $('#murid-table').DataTable({
                columnDefs: [
                    { orderable: true, targets: 1 },
                    { orderable: true, targets: 2 },
                    { orderable: false, targets: 0 }
                ]
            });

            $('#hapus-murid-table').DataTable({
                columnDefs: [
                    { orderable: true, targets: 0 },
                    { orderable: true, targets: 1 },
                    { orderable: false, targets: 2 }
                ]
            })
        });
    </script>
@endsection