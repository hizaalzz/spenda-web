@extends('layouts.test', ['soal' => $soal])
@section('title', 'Ujian')
@section('content')
    <div id="container">
        @livewire('card-ujian', ['soal' => $soal, 'jadwal' => $jadwal])
    </div>
@endsection
@section('js')
    <script src="{{ url('/js/ujian.js') }}"></script>
@endsection