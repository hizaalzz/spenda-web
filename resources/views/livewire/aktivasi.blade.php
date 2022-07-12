<div>
    <div class="d-flex">
        <div class="col- form-inline">
            <label for="statusDipilih" class="mr-1">Pilih status :</label>
            {!! Form::select('statusDipilih', ['Aktif' => 'Aktif', 'Nonaktif' => 'Nonaktif'], 'Aktif', 
                ['class' => 'form-control form-control-sm', 'wire:model' => 'statusDipilih']) !!}
        </div>  
    </div>
    <div class="d-flex flex-row flex-wrap">
        @forelse ($status as $item)
            <div class="card shadow-lg my-4 mr-3 rounded">
                <div class="card-header {{ $item->status == 'Aktif' ? 'bg-primary' : 'bg-danger' }} ">
                    <h3 class="card-title text-white">{{ $item->jadwal->matapelajaran->nama }}</h3>
                    <div class="d-flex">
                        <div class="item-detail">
                            <span class="text-white"><i class="mdi mdi-account"></i></span>
                            <span class="text-white">
                                @php
                                    $pelaksanaan = App\Models\Pelaksanaan::whereHas('murid', function($query) use($item) {
                                        $query->where('kelas_id', $item->jadwal->kelas_id);
                                    })->where('sesi_id', $item->sesi_id)->count();

                                    echo $pelaksanaan;
                                @endphp
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between py-2">
                            <span>Ujian dimulai : </span>
                            <div class="badge badge-primary my-auto">
                                <span>{{ TimeHelper::convert($item->jadwal->tanggal, 'd-m-Y') . ' ' . $item->sesi->start }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>Ujian ditutup : </span>
                            <div class="badge badge-danger my-auto">
                                <span>{{ TimeHelper::convert($item->jadwal->tanggal, 'd-m-Y') . ' ' .$item->sesi->end }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>Sesi : </span>
                            <span>{{ $item->sesi->nama }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>Guru : </span>
                            <span>{{ $item->jadwal->guru->nama }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>Status : </span>
                            <span>{{ $item->status }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>Token : </span>
                            <span>{{ $item->token ?? '-' }}</span>
                        </div>
                        <div class="text-center">
                            @if(TimeHelper::isPassed(TimeHelper::convert($item->jadwal->tanggal, 'Y-m-d') . ' ' . $item->sesi->end)) 
                                <h4 class="text-success text-lg">Selesai</h4>
                            @else 
                                @if(TimeHelper::isPassed(TimeHelper::convert($item->jadwal->tanggal, 'Y-m-d') . ' ' . $item->sesi->start))
                                    <h4 class="text-danger">Dalam Proses</h4>
                                @else 
                                    <h4 class="text-primary">Belum Dimulai</h4>
                                @endif
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                            {!! Form::open(['route' => ['aktivasi.update', $item]]) !!}
                            @csrf
                            @if($statusDipilih == 'Aktif')
                                {!! Form::hidden('status', 'Nonaktif') !!}
                                {!! Form::submit('Nonaktifkan', ['class' => 'btn btn-warning btn-sm rounded']) !!}

                            @else 
                                {!! Form::hidden('status', 'Aktif') !!}
                                {!! Form::submit('Aktifkan', ['class' => 'btn btn-warning btn-sm rounded']) !!}

                            @endif
                            {!! Form::close() !!}
                       
                        {!! Form::open(['route' => ['aktivasi.delete', $item->id], 'class' => 'delete-form', 'data-target' => $item->id]) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        <button class="btn btn-danger btn-sm mx-1" onclick="showModal(`Hapus data {{ $item->sesi->nama }}?`, `.delete-form`, `{{ $item->id }}`)">
                            <i class="mdi mdi-trash-can-outline"></i> Hapus
                        </button>
                        {!! Form::close() !!}
                        <a href="{{ route('penilaian.show', $item->jadwal->kelas_id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-book-search-outline"></i> Lihat Hasil</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="my-4">
                <span>Tidak ada data</span>
            </div>
        @endforelse
    </div>
    <x-delete-modal></x-delete-modal>
</div>
