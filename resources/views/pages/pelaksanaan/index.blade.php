@extends('layouts.dashboard')
@section('title', 'Kelas')
@section('content')
<x-page-title>
    <x-slot name="title">Pelaksanaan</x-slot>
    <x-slot name="item">
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <table class="table" id="kelas-table">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $item)
                        <tr>
                            <td>{{ $item->nama_kelas }}</td>
                            <td>
                                <a href="{{ route('pelaksanaan.details', $item->id) }}" class="btn btn-primary btn-sm">
                                    Buka <i class="mdi mdi-share"></i> 
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#kelas-table').DataTable();
        });
    </script>
@endsection