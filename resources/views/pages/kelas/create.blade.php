@extends('layouts.dashboard')
@section('title', 'Tambah Kelas')
@section('content')
<x-page-title>
    <x-slot name="title">Kelas</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Kelas</li>
        <li class="breadcrumb-item active">Tambah kelas</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Kelas</h3>
                <p class="card-title-desc">Buat kelas baru</p>
                {!! Form::open(['route' => 'class.store', 'id' => 'form-kelas']) !!}
                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    {!! Form::text('nama_kelas', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nama Kelas']) !!}
                </div>
                <div class="form-group">
                    <label for="level_id">Level Kelas</label>
                    {!! Form::select('level_id', $level, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="jurusan_id">Tingkat Kelas</label>
                    {!! Form::select('jurusan_id', $jurusan, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <h3 class="card-title mt-4">Pilih Murid</h3>
                <p class="card-title-desc">Pilih murid untuk kelas baru ini</p>
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
                                        {!! Form::checkbox('murid[]', $item->id, false) !!}
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! Form::input('button', 'random', 'Pilih satu secara acak', ['class' => 'btn btn-secondary', 'id' => 'btn-acak']) !!}
                <div class="text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary mt-2']) !!}
                </div>
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
        });
    </script>
@endsection