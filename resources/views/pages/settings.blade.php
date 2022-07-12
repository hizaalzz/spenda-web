@extends('layouts.dashboard')
@section('title', 'Setelan')
@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Setelan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Setelan</li>
        <li class="breadcrumb-item active">Edit Setelan</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Setelan</h3>
                <p class="card-title-desc">Ubah setelan</p>
                <textarea name="content" id="content" cols="30" rows="10" style="display: none;"></textarea>
                {!! Form::open(['route' => 'settings.store']) !!}
                @csrf
                <label>Ganti setelan text sambutan berjalan?</label>
                <div class="form-group">
                    <div class="form-check">
                        <input type="radio" value="yes" name="radioChange" id="radioChangeYes" class="form-check-input" 
                            @if(isset($sambutan) || $sambutan != null)checked @endif required>
                        <label for="radioChangeYes" class="form-check-label">Ya</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" value="no" name="radioChange" id="radioChangeNo" class="form-check-input" 
                            @if(!isset($sambutan) || $sambutan == null)checked @endif required>
                        <label for="radioChangeNo" class="form-check-label">Tidak, Biarkan menggunakan bawaan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sambutan">Teks sambutan berjalan</label>
                    <input type="text" name="sambutan" id="sambutan" class="form-control" value="{{ $sambutan ?? 'Default' }}" @if($sambutan == null)disabled @endif>
                </div>
                <div class="form-group">
                    <label for="tata_tertib">Tata Tertib</label>
                    {!! Form::textarea('tata_tertib', 'Default', ['class' => 'summernote', 'required']) !!}
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
    <script src="{{ asset('/vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        let sambutan = $("input[name='sambutan']");

        $("input[name='radioChange']").change(function() {
            if($(this).val() === 'yes') {
                sambutan.removeAttr('disabled');
            } else {
                sambutan.val('Default');
                sambutan.attr('disabled', 'disabled');
            }
        });
        
        $(document).ready(function() {
            let content = `{{ $tata_tertib }}`;

            $('#content').html(content);

            $('.summernote').summernote('code', $('#content').text());
        });
    </script>
@endsection