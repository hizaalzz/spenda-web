@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<x-page-title>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item active">Selamat Datang</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="avatar-sm font-size-20 mr-3">
                        <span class="avatar-title bg-soft-danger text-danger rounded">
                            <i class="mdi mdi-account-tie"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <div class="font-size-16">Guru</div>
                        <h6>{{ App\Models\Guru::count() }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="avatar-sm font-size-20 mr-3">
                        <span class="avatar-title bg-soft-primary text-primary rounded">
                            <i class="mdi mdi-account-supervisor"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <div class="font-size-16">Murid</div>
                        <h6>{{ App\Models\Murid::count() }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="avatar-sm font-size-20 mr-3">
                        <span class="avatar-title bg-soft-warning text-warning rounded">
                            <i class="mdi mdi-google-classroom"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <div class="font-size-16">Kelas</div>
                        <h6>{{ App\Models\Kelas::count() }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Jumlah Murid</h4>
                <div id="column_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengumuman</h4>
                <p class="card-title-desc">Ringkasan pengumuman terbaru</p>
                <div class="table-responsive">
                    <table class="table" id="pengumuman-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Isi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengumuman as $item)
                            <tr>
                                <td><a href="{{ route('pengumuman.show', $item->id) }}">{{ $item->judul }}</a></td>
                                <td class="konten">{!! strip_tags($item->konten) !!}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">Tidak ada pengumuman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(App\Models\Pengumuman::count() > 5)
                <div class="text-center">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-primary btn-sm">Lihat selengkapnya</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Log Aktifitas</h4>
                <p class="card-title-desc">Merekam setiap aktivitas yang dilakukan</p>
                <div class="table-responsive">
                    <table class="table" id="log-table">
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->description }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @if(App\Models\Logs::count() > 5)
                <div class="text-center">
                    <a href="{{ route('log.index') }}" class="btn btn-primary btn-sm">Lihat selengkapnya</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script>
        let dataKelas = [];
        let kelas = `{!! $kelas !!}`;

        let series = [];
        let colors = [];
        let categories = [];
        
        function generateRandomColor() {
            return Math.floor(Math.random()*16777215).toString(16);
        }

        $(document).ready(function() {
            if(kelas != null) {
                kelas = JSON.parse(kelas);
                kelas.forEach(e => {
                    let groupData = {
                        name: e.nama_kelas,
                        data: [e.murid_count]
                    };

                    series.push(groupData);
                    colors.push('#' + generateRandomColor())
                    categories.push(e.nama_kelas);
                });

                renderChart();
            }

        });

        function renderChart() {
            let options = {
                chart: {
                    height: 350,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "10%",
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 2,
                    colors: ["transparent"]
                },
                series: series,
                colors: colors,
                xaxis: {
                    categories: categories
                },
                yaxis: {
                    title: {
                        text: "Jumlah Murid"
                    }
                },
                grid: {
                    borderColor: "#f1f1f1"
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (e) {
                            return e + " orang"
                        }
                    }
                }
            };

            (chart = new ApexCharts(document.querySelector("#column_chart"), options)).render();
        }
    </script>
@endsection