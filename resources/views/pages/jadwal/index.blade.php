@extends('layouts.dashboard')
@section('title', 'Jadwal')
@section('content')
<x-page-title>
    <x-slot name="title">Jadwal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jadwal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        <h3 class="card-title">
                            Jadwal @if(auth('admin')->user()->hasRole('guru'))Anda @endif
                            @if(request()->has('kelas'))
                                {{ $kelas[request()->query('kelas')] }}
                            @endif
                        </h3>
                    </div>
                    <div>
                        @if(!auth('admin')->user()->hasRole('guru'))
                            <label for="kelas" class="text-sm mr-1">Pilih kelas :</label>
                            {!! Form::select('kelas', $kelas, request()->query('kelas') ?? null, ['id' => 'kelas']) !!}  
                        @endif
                    </div>
                </div>
                <div class="table-responsive"> 
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script>
        function redirectToCreate() {
            let route = "{{ route('jadwal.create') }}";

            window.location.href = route;
        }

        $('#kelas').change(function() {
            if($(this).val() == null || $(this).val() == '') {
                window.location.href = "{{ url('/jadwal') }}";
            } else {
                window.location.href = `{{ url('/jadwal?kelas=${$(this).val()}') }}`;

            }

        });

        $(document).ready(function() {
            // $('body').attr('data-keep-enlarged', true);
            // $('body').addClass('vertical-collpsed')
        });
    </script>


    {{ $dataTable->scripts() }}
@endpush