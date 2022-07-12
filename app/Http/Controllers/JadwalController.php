<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\JadwalDataTable;
use App\Http\Requests\JadwalRequest;
use App\Models\BankSoal;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\JenisUjian;
use App\Models\Matapelajaran;
use App\Models\Penilaian;
use App\Models\Permission;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Jadwal::class, 'jadwal');
    }

    public function index(JadwalDataTable $dataTable, Request $request)
    {   
        $kelas = $request->input('kelas', null);

        $matapelajaran = $request->input('matapelajaran', null);

        return $dataTable->with('kelas', $kelas, 'matapelajaran', $matapelajaran)->render('pages.jadwal.index');
    }

    public function create()
    {
        $jenisujian = JenisUjian::pluck('nama', 'id')->prepend('Pilih Jenis Ujian', '');

        return view('pages.jadwal.create', compact('jenisujian'));
    }

    public function store(JadwalRequest $request)
    {
        if(!$request->has('bobot_pg') && !$request->has('bobot_essay')) 
            return redirect()->back()->withErrors('Persentase bobot tidak valid')->withInput();
        
        // Validasi bank soal skala

        if($request->bank_soal_id) 
        {
            $bankSoal = BankSoal::with('level')->find($request->bank_soal_id);

            $kelas = Kelas::with('level')->find($request->kelas_id);

            if($kelas->level->skala < $bankSoal->level->skala) 
                return redirect()->back()->withErrors('Tidak dapat membuat jadwal karena bank soal yang dipilih dikhususkan untuk kelas yang lebih tinggi')
                    ->withInput();

        }

        $jadwal = new Jadwal($request->except('_token'));

        $jadwal->bank_soal_id = $request->bank_soal_id;
        $jadwal->jenisujian_id = $request->jenisujian_id;

        $jadwal->save();

        $penilaian = new Penilaian($request->only(['bobot_pg', 'bobot_essay']));
        $penilaian->jadwal_id = $jadwal->id;

        $penilaian->save();


        return redirect()->route('jadwal.index')->with('success', 'Berhasil membuat jadwal');
    }

    public function show(Jadwal $jadwal)
    {
        return view('pages.jadwal.details', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        $jurusan_id = $jadwal->kelas->jurusan_id;

        $matapelajaran = Matapelajaran::whereHas('jurusan', function($q) use($jurusan_id) {
            $q->where('jurusan_id', $jurusan_id);
        })->pluck('nama', 'id')->prepend('Pilih MataPelajaran', '');

        $banksoal = BankSoal::whereHas('jurusan', function($query) use($jurusan_id) {
            $query->where('id', $jurusan_id);
        })->where('matapelajaran_id', $jadwal->matapelajaran_id)->whereActive()->orderBy('id')->pluck('id', 'id')->prepend('Pilih Bank soal', '');

        $guru = Guru::whereHas('matapelajaran', function($q) use($jadwal) {
            $q->where('matapelajaran_id', $jadwal->matapelajaran_id);
        })->pluck('nama', 'id')->prepend('Pilih Guru', '');

        $jenisujian = JenisUjian::pluck('nama', 'id')->prepend('Pilih Jenis Ujian', '');
 

        return view('pages.jadwal.edit', array('jadwal' => $jadwal, 'matapelajaran' => $matapelajaran, 'banksoal' => $banksoal, 'jenisujian' => $jenisujian, 'guru' => $guru));
    }

    public function update(JadwalRequest $request, Jadwal $jadwal)
    {
        $jadwal->update([
            'kelas_id' => $request->kelas_id,
            'tanggal' => $request->tanggal,
            'tanggal_expire' => $request->tanggal_expire,
            'nama' => $request->nama,
            'matapelajaran_id' => $request->matapelajaran_id,
            'guru_id' => $request->guru_id,
            'durasi' => $request->durasi,
            'bank_soal_id' => $request->bank_soal_id,
            'kkm' => $request->kkm,
            'jenisujian_id' => $request->jenisujian_id
        ]);

        // $jadwal->matapelajaran->guru()->attach($request->guru_id);

        $jadwal->penilaian->update([
            'bobot_pg' => $request->bobot_pg,
            'bobot_essay' => $request->bobot_essay
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Berhasil mengupdate jadwal');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Berhasil menghapus jadwal');

    }
}
