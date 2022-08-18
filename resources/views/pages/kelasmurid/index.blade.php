@extends('layouts.dashboard')
@section('title', 'Kelas Murid')
@section('content')
<x-page-title>
    <x-slot name="title">Kelas Murid</x-slot>
    <x-slot name="item">
      
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Kelas Murid</h3>
                <p class="card-title-desc">Pembagian untuk murid yang belum memiliki kelas</p>
                {!! Form::open(['route' => 'kelasmurid.store']) !!}
                @csrf
                <div class="form-group">
                    <label for="kelas_id">Pilih Kelas</label>
                    {!! Form::select('kelas_id', $kelas, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <label class="mb-4">Pilih Murid</label>
                <div class="table-responsive">
                    <table class="table" id="murid-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" id="select_all"></th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($murid as $item)
                                <tr>
                                    <td>
                                        {!! Form::checkbox('murid_id[]', $item->id, false, ['data-target' => 'checkbox-murid']) !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('murid.show', $item->id) }}">{{ $item->nama }}</a>
                                    </td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                </tr>
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
@section('js')
    <script>
        $(document).ready(function() {
            $('#murid-table').DataTable({
                columnDefs: [{
                    targets: 0, orderable: false
                }],
                order: [[1, 'asc']],
                paging: false            
            });
        });

        $('#select_all').change(function() {
            let checkboxMurid = $('input[data-target=checkbox-murid]');
            if($(this).is(':checked')) {
                checkboxMurid.prop('checked', true);
            } else {
                checkboxMurid.prop('checked', false);
            }
        });
    </script>
@endsection