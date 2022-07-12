@extends('layouts.dashboard')
@section('title', 'Lihat Soal')
@section('css')
    <link rel="stylesheet" href="{{ asset('/libs/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<x-page-title>
    <x-slot name="title">Bank Soal</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Bank Soal</li>
        <li class="breadcrumb-item active">List Soal</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        <h3 class="card-title">Bank Soal</h3>
                        <p class="card-title-desc">Soal {{ $banksoal->matapelajaran->nama . ' - ' . $banksoal->guru->nama }}</p>
                    </div>
                    <div>
                        <label for="kelas" class="text-sm mr-1">Pilih Paket :</label>
                        {!! Form::select('paket', $paket, request()->query('paket') ?? null, ['id' => 'paket']) !!}  
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="dropdown mb-4 justify-content-end">
                        <button class="btn btn-success btn-sm my-auto dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria aria-expanded="true">
                            Tambah soal <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('soal.create', ['banksoal' => $banksoal->id]) }}" class="dropdown-item">
                               Form soal
                            </a>
                            <a href="{{ route('soal.upload', ['banksoal' => $banksoal->id]) }}" class="dropdown-item">
                               Import soal
                            </a>
                        </div>
                    </div>
                    <button class="btn btn-danger btn-sm my-auto" onclick="showModal(`Hapus data soal yang dipilih?`, `null`, 0, `deleteSelected`);">
                        <i class="fas fa-trash"></i> Hapus yang dipilih
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="soal-table" class="table">
                        <thead>
                            <tr>
                                <th>{!! Form::checkbox('select_all', null, false, ['id' => 'select_all']) !!}</th>
                                <th>Nomor Soal</th>
                                <th>Isi Soal</th>
                                <th>Paket</th>
                                <th>Jenis</th>
                                <th>Kunci Jawaban</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soal as $item)
                                <tr>
                                    <td>
                                        {!! Form::checkbox('deleteCheck[]', $item->id, false, ['data-target' => $item->id]) !!}
                                    </td>
                                    <td>{{ $item->nomor_soal }}</td>
                                    <td class="konten">
                                        <a href="#" onclick="showDetailSoal(`{{ $item->id }}`)" data-toggle="modal" data-target=".soal-modal">
                                            {{ strip_tags($item->isi) }}
                                        </a>
                                    </td>
                                    <td>{{ $item->paket->kode_soal }}</td>
                                    <td>
                                        @php 
                                            if($item->jenis == 1) {
                                                echo "Pilihan Ganda";
                                            } else {
                                                echo "Essay";
                                            }
                                        @endphp
                                    </td>
                                    <td class="konten">{{ $item->kunci_jawaban }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('konten.show', $item->id) }}" class="btn btn-dark btn-sm mr-1"
                                                data-toggle="tooltip" title="Lihat konten">
                                                    <i class="far fa-eye"></i>
                                            </a>
                                            <a href="{{ route('soal.edit', $item->id) }}" class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                                            <form action="{{ route('soal.destroy', $item->id) }}" class="ml-1 delete-form" id="form-delete" data-target="{{ $item->id }}" method='POST'>
                                                @csrf
                                                <input type='hidden' name='_method' value='delete'>
                                                <input type="hidden" name="soal_id" value="{{ $item->id }}">
                                                <button class='btn btn-danger btn-sm' onclick='showModal(`Hapus soal nomor {{ $item->nomor_soal }}?`, `.delete-form`, `{{ $item->id }}`);'>
                                                    <i class='fas fa-trash'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<x-delete-modal />

@include('components.soal-modal')

@endsection
@section('js')
    <script src="{{ asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>

        function deleteSelected() {
            const selected = Array.from(document.querySelectorAll("input[name='deleteCheck[]']:checked"));
            
            let valueSelected = selected.map(e => {
                return e.value;
            });
            
            $.ajax({
                method: 'DELETE',
                url: "{{ route('soal.delete.multiple') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'deleteCheck[]': valueSelected
                },
                success: function(data, textStatus, xhr) {
                    if(xhr.status == 200) {
                        Swal.fire('Berhasil menghapus soal', 'Soal yang dipilih berhasil dihapus', 'success');

                        window.location.reload();
                    }
                },
                error: function(xhr, textStatus) {
                    console.error(xhr.status);

                    Swal.fire('Terjadi kesalahan saat menghapus soal', 'Error code : ' + xhr.status, 'error');
                }  
            })
        }

        $(document).ready(function() {
            $('#soal-table').DataTable({
                order: [[1, 'asc']],
                columnDefs: [
                    { orderable: false, targets:0 }
                ]
            });

            $('#paket').change(function() {
                if($(this).val() == null || $(this).val() == '') {
                    window.location.href = `{{ url('/soal/${id}') }}`;
                } else {
                    window.location.href = `{{ url('/soal/${id}?paket=${$(this).val()}') }}`;
                }
            });

                    
            $('#select_all').change(function() {
                if($(this).is(':checked')) {
                    $("input[name='deleteCheck[]']").prop('checked', true);
                } else {
                    $("input[name='deleteCheck[]']").prop('checked', false);
                }
            }); 
        });
    </script>
@endsection