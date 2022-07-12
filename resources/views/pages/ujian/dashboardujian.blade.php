@extends('layouts.test')
@section('title', 'Persiapan')
@section('content')
    <div class="w-full bg-blue-500 marquee text-white z-30">
        <p>{{ $sambutan ?? 'Selamat Datang ' . auth()->user()->nama . ' . Jangan Lupa Berdoa Sebelum Ujian' }}</p>
    </div>
    <div id="container">
        <x-alert-test />
        @livewire('persiapan', [
            'pelaksanaan' => $pelaksanaan, 
            'jadwal' => $jadwal,
            'status' => $status,
            'tata_tertib' => $tata_tertib ?? null
        ])
    </div>
@endsection