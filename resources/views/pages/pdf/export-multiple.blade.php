@extends('layouts.dashboard')
@section('title', 'Print Nilai')
@section('css')
    <link rel="stylesheet" href="{{ asset('/libs/select2/css/select2.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Nilai</x-slot>
    <x-slot name="item">
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Ekspor</h3>
                {!! Form::open(['route' => 'export.pdf.multiple']) !!}
                <div class="form-group">
                    <label for="kelas">Pilih Kelas</label> <br>
                    {!! Form::select('kelas', $kelas, null, ['class' => 'form-control', 'id' => 'kelas', 'required']) !!}
                   
                </div>
                <label for="murid-table" class="my-3">Pilih Murid</label>
                <div class="table-responsive">
                    <table class="table" id="murid-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {{ Form::button('<i class="fas fa-print"></i> Print', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#kelas').select2();

        let muridTable = $('#murid-table').DataTable({
            columnDefs: [
                {'width': '10%', 'targets': 0}
            ]
        });

        $('#kelas').change(function() {
            const kelasValue = $(this).val();

            muridTable.clear();

            if(kelasValue != null) {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('murid.findby.kelas') }}",
                    data: {
                        'kelas': kelasValue
                    },
                    success: function(data) {
                        data.forEach((e) => {
                            const checkMurid = `<input type='checkbox' value='${e.id}' name='murid[]' />`

                            muridTable.row.add([
                                checkMurid, e.nama
                            ]).draw();
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });

    
</script>
@endsection