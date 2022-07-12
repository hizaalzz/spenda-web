@extends('layouts.dashboard')
@section('title', 'Aktivasi Ujian')
@section('content')
<x-page-title>
    <x-slot name="title">Aktivasi Ujian</x-slot>
    <x-slot name="item">
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'aktivasi.aktifkan', 'id' => 'aktivasi-form']) !!}
                @csrf
                {!! Form::hidden('token', null, ['id' => 'token-form']) !!}
                <h3>Pilih Jadwal</h3>
                <fieldset>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table" id="jadwal-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $item)
                                    <tr>
                                        <td>
                                            {!! Form::radio('jadwal_id', $item->id, false, ['required']) !!}
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kelas->nama_kelas }}</td>
                                        <td>{{ $item->matapelajaran->nama }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
                <h3>Aktivasi</h3>
                <fieldset>
                    <div class="row">
                        <div class="col">
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sesi">Sesi</label>
                                        {!! Form::select('sesi_id', $sesi, null, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="Aktif">Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="bg-info w-100 rounded p-3">
                                        <div class="form-check form-check-inline">

                                            <label for="usetoken" class="form-check-label mr-1 text-light">Gunakan token</label>
                                            <input type="checkbox" name="usetoken" id="usetoken" class="form-check-input" checked>
                                        </div>
                                        <div class="d-flex">
                                            <h2 class="text-light">Token : </h2>
                                            <h2 id="token" class="ml-1 text-light">Mendapatkan token</h2>
                                        </div>
                                        <div id="qrcode" class="d-flex justify-content-center mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
        @livewire('aktivasi')
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('/js/qrcode.min.js') }}"></script>
    <script src="{{ asset('/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
         
    <script>
        
        $(function() {
            let form = $("#aktivasi-form");
            let qrcode;

            $(document).ready(function() {
                $('#jadwal-table').DataTable();

                const jadwal = @json($jadwal);
                let token = document.querySelector('#token');
                qrcode = new QRCode('qrcode', {
                    width: 128,
                    height: 128,
                    colorDark : "#000000",
                    colorLight : "#0CAADC",
                    correctLevel : QRCode.CorrectLevel.H
                });

                getToken();
            });

            form.validate({
                errorPlacement: function errorPlacement(error, element) { element.before(error); }
            });
            
            form.steps({
                    headerTag:"h3",
                    bodyTag:"fieldset",
                    transitionEffect:"slide",
                    onStepChanging: function(event, currentIndex, newIndex) {
                        if(newIndex == 1) {
                            getToken();
                        }

                        form.validate().settings.ignore = ":disabled,:hidden";
                        return form.valid();
                    },
                    onFinished: function(event, currentIndex) { 
                        form.submit();
                    }
            });

            $('#usetoken').change(function() {
                if($(this).is(':checked')) {
                    getToken();
                } else {
                    hideToken();
                }
            });

            function hideToken() {
                let tokenForm = document.querySelector('#token-form');
                tokenForm.value = null;
                
                token.innerHTML = '-';

                qrcode.clear();
            }

            function getToken() {      
                qrcode.clear();
                                
                $.ajax({
                    url: "{{ route('aktivasi.gettoken') }}",
                    type: 'GET',
                    success: function(response) {
                        token.innerHTML = response;

                        let tokenForm = document.querySelector('#token-form');
                        tokenForm.value = response;

                        qrcode.makeCode(response);
                    }
                });
            }
        });        
    </script>
@endsection