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
            <p class="text-sm uppercase">Sekolah Menengah Pertama Negeri 2 Kota Cirebon</p>
            <p class="text-xs">
                Jl.siliwangi, No. 94, Kebon Baru, Kejaksan, Kota Cirebon, Provinsi Jawa Barat.
            </p>
        </div>
        <hr class="thin">
        <hr class="bold mt-1">
    </header>

    <footer>Copyright</footer>

    <main>
        <div style="page-break-after: always;">

            <div class="font-normal text-sm w-full mt-4">
                <p class="font-semibold text-center text-xl uppercase underline mb-2">Laporan Hasil Belajar</p>
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
                        <td>Tingkat Kelas</td>
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
</body>

</html>
