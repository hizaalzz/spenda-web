@extends('layouts.dashboard')
@section('title', 'Tingkat Kelas')
@section('content')
<x-page-title>
    <x-slot name="title">Tingkat Kelas</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Tingkat Kelas</li>
        <li class="breadcrumb-item active">Tambah Tingkat Kelas</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Data Tingkat Kels</h3>
                <p class="card-title-desc">Isi form dibawah untuk menambahkan</p>
                {!! Form::open(['route' => 'jurusan.store', 'id' => 'createForm', 'class' => 'outer-repeater']) !!}
                @csrf
                <div class="form-group">
                    <label for="nama">Kode Tingkat Kelas</label>
                    {!! Form::text('kode_tingkat', null, ['class' => 'form-control', 'placeholder' => 'Kode Tingkat Kelas', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="nama">Nama Tingkat Kelas</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Tingkat Kelas', 'required']) !!}
                </div>
                <br>
                <h3 class="card-title">Pilih Mata Pelajaran</h3>
                <p class="card-title-desc">Pilih mata pelajaran untuk tingkat kelas baru ini</p>

                <div class="table-responsive">
                    <table class="table" id="matapelajaran">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matapelajaran as $m)
                                <tr>
                                    <td style="width: 50px;">{!! Form::checkbox('matapelajaran[]', $m->id, false) !!}</td>
                                    <td>{{ $m->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-2">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#matapelajaran').DataTable({
                columnDefs: [
                    { orderable: true, targets: 1 },
                    { orderable: false, targets: 0 }
                ]
            });
        });

        let form = $('#createForm');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endpush