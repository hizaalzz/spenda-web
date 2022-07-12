@extends('layouts.dashboard')
@section('title', 'Buat Soal')
@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Soal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Soal</li>
        <li class="breadcrumb-item active">Buat Soal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Buat Soal Baru</h3>
                <p class="card-title-desc">Lengkapi form dibawah untuk membuat soal</p>
                {!! Form::open(['route' => 'soal.store', 'id' => 'form-jadwal', 'enctype' => 'multipart/form-data']) !!}
                <h3>Pilih Paket</h3>
                <fieldset>
                    {!! Form::hidden('bank_soal_id', $banksoal->id) !!}
                    <div class="form-group">
                        <label for="paket_id">Paket soal</label>
                        {!! Form::select('paket_id', $paket, null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </fieldset>
                <h3>Soal</h3>
                <fieldset>
                    <div class="row p-3">
                        <p class="mr-3"><strong>Pilih Tipe Soal</strong></p>
                        <div class="form-check mr-2">
                            {!! Form::radio('jenis', 1, true, ['class' => 'form-check-input', 'id' => 'radio-pilihanganda', 'required']) !!}
                            <label for="radio-pilihanganda" class="form-check-label">Pilihan Ganda</label>
                        </div>
                        <div class="form-check">
                            {!! Form::radio('jenis', 2, false, ['class' => 'form-check-input', 'id' => 'radio-essay', 'required']) !!}
                            <label for="radio-essay" class="form-check-label">Essay</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <h5>Isi Soal</h5>
                            <div class="form-group">
                                {!! Form::textarea('isi', null, ['class' => 'summernote text-black']) !!}
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="audio">File Audio Pendukung</label>
                                    <small class="text-danger">(Opsional)</small>
                                </div>
                                {!! Form::file('audio', ['class' => 'form-control', 'accept' => 'audio/*']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <h5 id="labelpilihanganda">Pilihan Ganda</h5>
                            <div id="accordion">
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
                                    @if($banksoal->opsi_pg === '3' || $banksoal->opsi_pg === '4')
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
                                    @if($banksoal->opsi_pg >= '4')
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
                                    @if($banksoal->opsi_pg === '5')
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
                                            <div class="form-group" id="kunci-jawaban-container">
                                                {!! Form::select('kunci_jawaban', $pilihanGanda,
                                                null, ['id' => 'kunci_jawaban', 'class' => 'form-control', 'required']) !!}
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
        let form = $("#form-jadwal");

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
        deteksiJenis();
        
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

        //$('body').attr('data-keep-enlarged', true);
        //$('body').addClass('vertical-collpsed')

        $('input[name=jenis]').change(function() {
            deteksiJenis();
        });

        function deteksiJenis() {
            const val = $('input[name=jenis]:checked').val();

            // Input models for kunci jawaban (flexible)
            const kunciJawabanField = `<textarea name='kunci_jawaban' id='kunci_jawaban' class='form-control' />`;
            const kunciJawabanSelect = `{!! Form::select('kunci_jawaban', $pilihanGanda, null, ['id' => 'kunci_jawaban', 'class' => 'form-control', 'required']) !!}`;

            if(val == 2) {
                $('#labelpilihanganda').hide();
                $('#opsi-pilihan-ganda').hide();

                //remove select input when using essay model and use textarea field
                let kunci = document.querySelector('#kunci_jawaban');
                
                kunci.remove();

                $('#kunci-jawaban-container').append(kunciJawabanField);


            } else if(val == 1) {
                $('#labelpilihanganda').show();
                $('#opsi-pilihan-ganda').show();

                //remove field input when using pilihan ganda model and use select
                let kunci = document.querySelector('#kunci_jawaban');
                
                kunci.remove();

                $('#kunci-jawaban-container').append(kunciJawabanSelect);
            }
        }
    });

</script>
@endpush