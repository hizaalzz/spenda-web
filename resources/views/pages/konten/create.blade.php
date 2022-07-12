@extends('layouts.dashboard')
@section('title', 'Buat konten')
@section('css')
    <link rel="stylesheet" href="{{ asset('/libs/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/sweetalert2/sweetalert2.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Konten</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Konten</li>
        <li class="breadcrumb-item active">Buat</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Buat Konten</h3>
                <p class="card-title-desc mb-5">Tambah konten untuk soal</p>

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
                <h3 class="font-size-15 font-weight-bold">Upload Konten</h3>
                {!! Form::open(['route' => 'paket.store', 'id' => 'form-paket', 'enctype' => 'multipart/form-data']) !!}
                <h3>Layout</h3>
                <fieldset>
                    {!! Form::hidden('soal_id', $soal->id) !!}
                    <label>Layout file pada soal</label> <br>
                    <div class="form-check form-check-inline">
                        {!! Form::radio('layout', 'top', true, ['class' => 'form-check-input', 'id' => 'top', 'required']) !!}
                        <label for="top" class="form-check-label">Atas</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!! Form::radio('layout', 'bottom', false, ['class' => 'form-check-input', 'id' => 'bawah', 'required']) !!}
                        <label for="bawah" class="form-check-label">Bawah</label>
                    </div>
                </fieldset>
                <h3>Upload File</h3>
                <fieldset>
                    <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@section('js')
    <script src="{{ asset('/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        Dropzone.autoDiscover = false;

        let form = $("#form-paket");
        let contentIndex = "{{ route('banksoal.index') }}";
        let dropzone;

        $(function() {

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
                        dropzone.processQueue();
                    }
            });

        });

        $(document).ready(function() {
            dropzone = new Dropzone(".dropzone", {
                url: "{{ route('dropzone.store') }}",
                autoProcessQueue: false,
                maxFiles: 5,
                dictResponseError: 'Error uploading file!',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(file, response) {
                    Swal.fire('Berhasil mengupload', 'Konten/media berhasil ditambahkan', 'success');

                    window.location.href = contentIndex;
                },
                init: function() {
                    this.on("sending", function(file, xhr, data) {
                        const formDataArray = form.serializeArray();

                        formDataArray.forEach((item) => {
                            data.append(item.name, item.value);
                        })
                    });
                },
                error: function(xhr) {
                    Swal.fire('Gagal mengupload', 'Konten/media gagal diupload', 'error');

                    console.error(xhr.responseText);
                }
            });

            $('#jadwal-table').DataTable();
        })
    </script>
@endsection