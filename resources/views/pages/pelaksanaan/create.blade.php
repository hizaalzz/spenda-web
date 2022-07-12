@extends('layouts.dashboard')
@section('title', 'Buat Jadwal Pelaksanaan')
@section('content')
<x-page-title>
    <x-slot name="title">Pelaksanaan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Pelaksanaan</li>
        <li class="breadcrumb-item active">Buat Pelaksanaan</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Form Jadwal Pelaksanaan</h3>
                <p class="card-title-desc">Buat jadwal pelaksanaan</p>
                {!! Form::open(['route' => ['pelaksanaan.store', $kelas->id], 'id' => 'pelaksanaan-form']) !!}
                <h3>Pilih Jadwal</h3>
                <fieldset>
                    <div class="table-responsive mb-4">
                        <table class="table" id="jadwal-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Mata Pelajaran</th>
                                    <th>Nama</th>
                                    <th>Jenis Ujian</th>
                                    <th>Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwal as $item)
                                <tr>
                                    <td>{!! Form::radio('jadwal_id', $item->id, null) !!}</td>
                                    <td>{{ $item->matapelajaran->nama }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenisujian->nama }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </fieldset>
                <h3>Pelaksanaan</h3>
                <fieldset>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="sesi_id">Sesi</label>
                                {!! Form::select('sesi_id', $sesi, null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="paket_id">Paket Soal</label>
                                {!! Form::select('paket_id', $paket, null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ruangan_id">Ruangan</label>
                        {!! Form::select('ruangan_id', $ruangan, null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <label class="my-4">Pilih Murid</label>
                    <div class="table-responsive">
                        <table class="table" id="muridTable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" id="select_all"></th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($murid as $item)
                                    <tr>
                                        <td>{!! Form::checkbox('murid_id[]', $item->id, false, ['data-target' => 'checkbox-murid']) !!}</td>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
         $(function() {
            let form = $("#pelaksanaan-form");

            form.validate({
                errorPlacement: function errorPlacement(error, element) { element.before(error); }
            });
            
            form.steps({
                    headerTag:"h3",
                    bodyTag:"fieldset",
                    transitionEffect:"slide",
                    onStepChanging: function(event, currentIndex, newIndex) {
                        form.validate().settings.ignore = ":disabled,:hidden";
                        return form.valid();
                    },
                    onFinished: function(event, currentIndex) { 
                        form.submit();
                    }
            });

            $('#select_all').change(function() {
                let checkboxMurid = $('input[data-target=checkbox-murid]');

                if($(this).is(':checked')) {
                    checkboxMurid.prop('checked', true);
                } else {
                    checkboxMurid.prop('checked', false);
                }
            });

            $('input[data-target=checkbox-murid]').change(function() {
                if($(this).checked == false) {
                    console.log(false);
                }
            });
        });

        $(document).ready(function() {
            $('#muridTable').DataTable({
                order: [[1, 'asc']],
                pageLength: 50,
                columnDefs: [{
                    targets:0, orderable:false
                }]
            });

            $('#jadwal-table').DataTable({
                order: [[1, 'asc']],
                columnDefs: [{
                    targets:0, orderable:false, width: "5%"
                }]
            })
        });
    </script>
@endsection