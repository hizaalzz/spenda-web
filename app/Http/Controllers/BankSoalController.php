<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use HandleFile;
use App\Models\BankSoal;
use App\Models\Jurusan;
use App\Models\Level;
use App\Models\Matapelajaran;
use App\Models\Soal;
use App\Models\Guru;
use App\DataTables\BankSoalDataTable;
use App\Http\Requests\BankSoalRequest;

class BankSoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(BankSoal::class, 'banksoal');    
    }

    public function index(BankSoalDataTable $dataTable)
    {
        return $dataTable->render('pages.banksoal.index');
    }

    public function create()
    { 
        $guru = null; 

        if(!auth('admin')->user()->hasRole('admin'))
        {
            $guru = Guru::findOrFail(auth('admin')->user()->guru_id);
        } else {
            $guru = Guru::whereNotIn('nama', ['admin'])->pluck('nama', 'id')->prepend('Pilih Guru', '');
        }
      
        return view('pages.banksoal.create', compact('guru'));
    }

    public function store(BankSoalRequest $request)
    {
        $banksoal = new BankSoal($request->except('_token'));

        $banksoal->save();

        return redirect()->route('banksoal.index')->with('success', 'Berhasil menyimpan bank soal');
    }

    public function show(Request $request, BankSoal $banksoal)
    {
        $paket = $request->input('paket');

        $soal = $paket === null ? Soal::where('bank_soal_id', $banksoal->id)->orderBy('nomor_soal')->get() :
            Soal::where('bank_soal_id', $banksoal->id)->where('paket_id', $paket)->orderBy('nomor_soal')->get();

        return view('pages.banksoal.details', compact('soal', 'banksoal'));
    }

    public function edit(BankSoal $banksoal)
    {
        
        if(!auth('admin')->user()->hasRole('admin')) {
            $guru = Guru::findOrFail(auth('admin')->user()->guru_id);
        } else {
            $guru = Guru::whereNotIn('nama', ['admin'])->pluck('nama', 'id')->prepend('Pilih Guru', '');

        }
        return view('pages.banksoal.edit', compact('guru', 'banksoal'));
    }

    public function update(BankSoalRequest $request, BankSoal $banksoal)
    {
        $banksoal->update([
            'opsi_pg' => $request->opsi_pg,
            'matapelajaran_id' => $request->matapelajaran_id,
            'jurusan_id' => $request->jurusan_id,
            'guru_id' => $request->guru_id,
            'level_id' => $request->level_id,
            'status' => $request->status
        ]);

        return redirect()->route('banksoal.index')->with('success', 'Berhasil mengupdate bank soal');
    }

    public function destroy(BankSoal $banksoal)
    {
        foreach($banksoal->soal as $soal) 
        {
            if($soal->konten->count()) {
                foreach($soal->konten as $konten) {
                    $deleteContent = $konten->type === 'image' ? HandleFile::delete($konten->isi, config('enums.path.image')) :
                        HandleFile::delete($konten->isi, config('enums.path.audio'));
    
                    if(!$deleteContent) continue;
    
                    $konten->delete();
    
                }            
            }
    
            $soal->delete();
        }

        $banksoal->delete();

        return redirect()->route('banksoal.index')->with('success', 'Berhasil menghapus bank soal');

    }
}
