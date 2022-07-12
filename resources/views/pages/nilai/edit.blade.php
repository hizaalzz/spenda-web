@extends('layouts.dashboard')
@section('title', 'Penilaian')
@section('css')
    <link rel="stylesheet" href="{{ url('/css/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Edit Nilai</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Nilai</li>
        <li class="breadcrumb-item active">Edit Nilai</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Nilai {{ $murid->nama }}</h3>
                <p class="card-title-desc">Edit nilai {{ $murid->nama . ' - ' . $jadwal->matapelajaran->nama }}</p>
                {!! Form::open(['route' => ['nilai.update', $nilai], 'id' => 'form-nilai']) !!}
                @method('PUT')
                @livewire('input-nilai', ['nilai' => $nilai->nilai])
                <div class="text-center">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <div>
                        <h3 class="card-title">Koreksi Jawaban</h3>
                        <p class="card-title-desc">Koreksi jawaban secara manual</p>
                    </div>
                    {!! Form::open(['route' => 'nilai.pg.otomatis']) !!}
                    @csrf 
                    {!! Form::hidden('jadwal_id', $jadwal->id) !!}
                    {!! Form::hidden('murid_id', $murid->id) !!}

                    {!! Form::submit('Nilai Pilihan Ganda Otomatis', ['class' => 'btn btn-success btn-sm']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="table-responsive">
                    <table class="table" id="jawaban-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Isi Soal</th>
                                <th>Kunci Jawaban</th>
                                <th>Jawaban</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jawaban as $item)
                                <tr>
                                    <td>{{ $item->soal->nomor_soal }}</td>
                                    <td class="konten">
                                        <a href="#" onclick="event.preventDefault(); showDetailSoal({{ $item->soal_id }})">{!! strip_tags($item->soal->isi) !!}</a>
                                    </td>
                                    <td class="konten">{{ $item->soal->kunci_jawaban }}</td>
                                    <td class="konten">{{ $item->jawaban }}</td>
                                    <td class="status">
                                        <div class="status-{{$item->id}}">
                                            @if($item->status === 'Benar')
                                                <i class="mdi mdi-check-circle-outline" style="color:green;"></i> Benar
                                            @elseif($item->status === 'Salah')
                                                <i class="mdi mdi-window-close" style="color:red;"></i> Salah

                                            @endif
                                        </div>

                                        <div class="radio-{{ $item->id }} d-none">
                                            <div class="form-check form-check-inline">
                                                <input value="Benar" class="form-check-input" type="radio" name="opsi-{{ $item->id }}" id="benar-{{ $item->id }}">
                                                <label for="benar-{{ $item->id }}" class="form-check-label">Benar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input value="Salah" class="form-check-input" type="radio" name="opsi-{{ $item->id }}" id="salah-{{ $item->id }}">
                                                <label for="salah-{{ $item->id }}" class="form-check-label">Salah</label>
                                            </div>
                                        </div>       
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm btn-edit-{{$item->id}}" 
                                            onclick="event.preventDefault(); showRadio(`{{ $item->id }}`)">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <div class="btn-item-{{ $item->id }} d-none">
                                            <a href="#" class="btn btn-primary btn-sm m-1" onclick="event.preventDefault(); hideRadio(`{{$item->id}}`); saveStatus(`{{$item->id}}`);">
                                                <i class="fas fa-save"></i> Simpan
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm m-1" onclick="event.preventDefault(); hideRadio(`{{$item->id}}`)">
                                                <i class="fas fa-times"></i> Cancel
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @livewire('penghitung', ['murid' => $murid->id, 'jadwal' => $jadwal])
            </div>
        </div>
    </div>
</div>
@include('components.jawaban-modal')
@endsection
@section('js')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script> 
    <script src="{{ asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>  

    <script>
        let form = $('#form-nilai');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        });

        function showRadio(id) {            
            toggleElement(id);
        }

        function toggleElement(id) {
            let radio = document.querySelector(`.radio-${id}`);
            radio.classList.toggle('d-none');

            let btnItem = document.querySelector(`.btn-item-${id}`);
            btnItem.classList.toggle('d-none');

            let btnEdit = document.querySelector(`.btn-edit-${id}`);
            btnEdit.classList.toggle('d-none');

            let status = document.querySelector(`.status-${id}`);
            status.classList.toggle('d-none');
        }

        function saveStatus(jawabanId) {
            let checkValue = document.querySelector(`input[type='radio'][name='opsi-${jawabanId}']:checked`);

            if(checkValue == null) {
                Swal.fire('Gagal menyimpan', 'Status jawaban belum dipilih', 'error');

                return;
            }

            checkValue = checkValue.value;

            $.ajax({
                url: "{{ route('jawaban.store') }}",
                type: "POST",
                data: {
                    jawaban_id: jawabanId,
                    status: checkValue,
                    _token: "{{ csrf_token() }}"
                }, 
                success: function(response) {
                    Livewire.emit('nilaiChanged');

                    if(response) loadStatus(jawabanId);
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire('Gagal menyimpan', xhr.responseText, 'error');
                }
            });

            
        }

        function loadStatus(jawabanId) {
            const correctTemplate = `<i class="mdi mdi-check-circle-outline" style="color:green;"></i> Benar`;
            const incorrectTemplate = `<i class="mdi mdi-window-close" style="color:red;"></i> Salah`;
            const loadingTemplate = `<div class="spinner-border text-danger"></div>`;

            let status = document.querySelector(`.status-${jawabanId}`);

            status.innerHTML = loadingTemplate;

            $.ajax({
                type: 'GET',
                url: `{{ url('/jawaban') }}/${jawabanId}`,
                success: function(response) {

                    status.innerHTML = response.status == 'Benar' ? correctTemplate : incorrectTemplate;

                }
            })
        }

        function hideRadio(id) {
            toggleElement(id);
        }
    </script>
@endsection