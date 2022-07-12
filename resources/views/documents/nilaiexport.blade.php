<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/test-optional.css') }}">

    <style>
        body {
            background-color: #fff !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        @page {
            margin-top: 120px;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
            height: 50px;
        }


        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }

        .page-number::before {
            content: "Halaman "counter(page);
        }

        hr.bold {
            border: 3px solid black;
        }

        hr.thin {
            border: 1px solid black;
        }

    </style>
</head>

<body>
    <header>
        <div class="w-full text-center tracking-wider mb-0 mt-1">
            <img src="{{ asset('/images/cbt_logo_only.svg') }}" alt="" class="w-24 float-left h-auto">
            <p class="text-sm uppercase">Pemerintah Kota Cirebon</p>
            <p class="text-sm uppercase">Dinas pendidikan dan kebudayaan</p>
            <p class="font-semibold text-lg uppercase">SMK CBT-Exam</p>
            <p class="text-xs">
                Jl. Kapten Samadikun No.60, Kesenden, Kec. Kejaksan, Kota Cirebon, Jawa Barat 45121
            </p>
        </div>
        <hr class="thin">
        <hr class="bold mt-1">
    </header>

    <footer>Copyright</footer>

    <main>
        <div style="page-break-after: always;">

            <div class="font-normal text-sm w-full mt-4">
                <p class="font-semibold text-center text-xl uppercase underline mb-2">laporan hasil belajar</p>
                <table class="table-auto w-full">
                    <tr>
                        <td>Nama</td>
                        <td class="font-bold">: {{ $murid->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>: {{ $murid->nis }}</td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>: {{ $murid->nisn }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>: {{ $murid->kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td>Kompetensi Keahlian</td>
                        <td>: {{ $murid->kelas->jurusan->nama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Nama Ujian</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai as $item)
                    <tr>
                        <td>{{ $item->jadwal->matapelajaran->nama }}</td>
                        <td>{{ $item->jadwal->guru->nama }}</td>
                        <td>{{ $item->jadwal->nama }}</td>
                        <td>{{ $item->nilai }}</td>
                        <td>
                            @if($item->nilai >= $item->jadwal->kkm)
                                TUNTAS
                            @else 
                                BELUM TUNTAS
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    {{-- <div class="w-full mt-0">
        <div class="text-center uppercase tracking-wider mb-0">
            <img src="{{ asset('/images/cbt_logo_only.svg') }}" alt="" class="float-left mt-6 w-24 h-auto">
    <p class="text-sm">Dinas pendidikan dan kebudayaan</p>
    <p class="font-semibold text-xl">SMK CBT-Exam</p>
    <p class="text-sm font-bold">Kecamatan Kejaksan Kota Cirebon</p>
    <p class="text-sm">
        Jl. Tentara Pelajar Kelurahan Kejaksan Kecamatan Kejaksan Kota Cirebon
    </p>
    </div>
    </div>
    <hr class="thin">
    <hr class="bold mt-1">
    <p class="font-semibold text-center text-xl uppercase mt-2">raport</p>
    <div class="font-normal text-sm">
        <div class="mt-4">
            Nama : {{ $murid->nama }}
        </div>
        <div class="mt-2">
            Kelas : {{ $murid->kelas->nama_kelas }}
        </div>
        <div class="mt-2">
            NIS : {{ $murid->nis }}
        </div>
        <div class="mt-2">
            NISN : {{ $murid->nisn }}
        </div>
    </div>
    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th>Matapelajaran</th>
                <th>Guru</th>
                <th>Nama Ujian</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilai as $item)
            <tr>
                <td>{{ $item->jadwal->matapelajaran->nama }}</td>
                <td>{{ $item->jadwal->guru->nama }}</td>
                <td>{{ $item->jadwal->nama }}</td>
                <td>{{ $item->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
</body>

</html>
