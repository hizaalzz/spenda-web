@extends('layouts.dashboard')
@section('title', 'Edit Soal')
@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Soal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Soal</li>
        <li class="breadcrumb-item active">Edit Soal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Soal</h3>
                <p class="card-title-desc">Lengkapi form dibawah untuk mengedit soal</p>
                {!! Form::model($soal, ['route' => ['soal.update', $soal->id], 'id' => 'form-soal', 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <h3>Pilih Paket</h3>
                <fieldset>
                    {!! Form::hidden('bank_soal_id', null) !!}
                    <div class="form-group">
                        <label for="paket_id">Paket soal</label>
                        {!! Form::select('paket_id', $paket, null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </fieldset>
                <h3>Soal</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <h5>Isi Soal</h5>
                            <div class="form-group">
                                {!! Form::textarea('isi', null, ['class' => 'summernote text-black']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <h5>{{ $soal->jenis == 1 ? 'Pilihan Ganda' : 'Jawaban Essay' }}</h5>
                            <div id="accordion"> 
                                @if($soal->jenis == 1)
                                <div id="opsi-pilihan-ganda">
                                    <div class="card mb-1 shadow-none">
                                        <div class="card-header" id="pilihan-A">
                                            <h6 class="m-0">
                                                <a href="#collapsePilihan-A" class="text-dark" data-toggle="collapse"
                                                    aria-expanded="true" aria-controls="collapsePilihan-A">Pilihan A</a>
                                            </h6>
                                        </div>
                                        <div id="collapsePilihan-A" class="collapse mt-1" aria-labelledby="pilihan-A"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    {!! Form::textarea('pilA', null, ['class' => 'summernote', 'required'])
                                                    !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-1 shadow-none">
                                        <div class="card-header" id="pilihan-B">
                                            <h6 class="m-0">
                                                <a href="#collapsePilihan-B" class="text-dark" data-toggle="collapse"
                                                    aria-expanded="true" aria-controls="collapsePilihan-B">Pilihan B</a>
                                            </h6>
                                        </div>
                                        <div id="collapsePilihan-B" class="collapse" aria-labelledby="pilihan-B"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    {!! Form::textarea('pilB', null, ['class' => 'summernote', 'required'])
                                                    !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($soal->banksoal->opsi_pg === '3' || $soal->banksoal->opsi_pg === '4')
                                    <div class="card mb-1 shadow-none">
                                        <div class="card-header" id="pilihan-C">
                                            <h6 class="m-0">
                                                <a href="#collapsePilihan-C" class="text-dark" data-toggle="collapse"
                                                    aria-expanded="true" aria-controls="collapsePilihan-C">Pilihan C</a>
                                            </h6>
                                        </div>
                                        <div id="collapsePilihan-C" class="collapse" aria-labelledby="pilihan-C"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    {!! Form::textarea('pilC', null, ['class' => 'summernote']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($soal->banksoal->opsi_pg >= '4')
                                    <div class="card mb-1 shadow-none">
                                        <div class="card-header" id="pilihan-D">
                                            <h6 class="m-0">
                                                <a href="#collapsePilihan-D" class="text-dark" data-toggle="collapse"
                                                    aria-expanded="true" aria-controls="collapsePilihan-D">Pilihan D</a>
                                            </h6>
                                        </div>
                                        <div id="collapsePilihan-D" class="collapse" aria-labelledby="pilihan-D"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    {!! Form::textarea('pilD', null, ['class' => 'summernote']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($soal->banksoal->opsi_pg === '5')
                                    <div class="card mb-1 shadow-none">
                                        <div class="card-header" id="pilihan-E">
                                            <h6 class="m-0">
                                                <a href="#collapsePilihan-E" class="text-dark" data-toggle="collapse"
                                                    aria-expanded="true" aria-controls="collapsePilihan-E">Pilihan E</a>
                                            </h6>
                                        </div>
                                        <div id="collapsePilihan-E" class="collapse" aria-labelledby="pilihan-E"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    {!! Form::textarea('pilE', null, ['class' => 'summernote']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                                <div class="card mb-1 shadow-none">
                                    <div class="card-header" id="jawaban">
                                        <h6 class="m-0">
                                            <a href="#collapseJawaban" class="text-dark" data-toggle="collapse"
                                                aria-expanded="true" aria-controls="collapseJawaban">Jawaban</a>
                                        </h6>
                                    </div>
                                    <div id="collapseJawaban" class="collapse" aria-labelledby="jawaban"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-group">
                                                @if($soal->jenis == 1)
                                                    {!! Form::select('kunci_jawaban', $pilihanGanda,
                                                    null, ['class' => 'form-control', 'required']) !!}
                                                @else 
                                                    {!! Form::textarea('kunci_jawaban', null, ['class' => 'form-control', 'required']) !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
<script src="{{ asset('/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>

<script>
    $(function () {
        let form = $("#form-soal");

        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            }
        });

        form.steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "slide",
            onStepChanging: function (event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                form.submit();
            }
        });
    });

    $(document).ready(function () {
        $('#jadwal-table').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, "asc"]
            ]
        });

        $('.summernote').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: !0,
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                    'subscript', 'clear'
                ]],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['insert', ['picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

</script>
@endpush
