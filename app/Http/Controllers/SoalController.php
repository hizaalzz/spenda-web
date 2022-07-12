<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Purifier;
use HandleFile;
use Summernote;
use App\Models\Soal;
use App\Models\BankSoal;
use App\Models\Konten;
use App\Http\Requests\SoalRequest;

class SoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Soal::class, 'soal');  
    }

    public function index(Request $request)
    {
        ///
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->has('banksoal')) return redirect()->back()->withErrors('Pilih bank soal terlebih dahulu');

        $banksoal = BankSoal::find($request->banksoal);

        $pilihanGanda = ['A' => 'A', 'B' => 'B'];

        if($banksoal->opsi_pg >= 3) $pilihanGanda = array_merge($pilihanGanda,['C' => 'C']);
        if($banksoal->opsi_pg >= 4) $pilihanGanda = array_merge($pilihanGanda, ['D' => 'D']);
        if($banksoal->opsi_pg === 5) $pilihanGanda = array_merge($pilihanGanda, ['E' => 'E']);

        $pilihanGanda = array_merge(['' => 'Pilih Jawaban'], $pilihanGanda);


        return view('pages.soal.create', compact('banksoal', 'pilihanGanda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SoalRequest $request)
    {
        if($request->jenis == 1 && ($request->pilA === null && $request->pilB === null)) 
            return redirect()->back()->withErrors('Soal yang dibuat tidak valid')->withInput();


        $lastNumber = Soal::orderBy('nomor_soal', 'desc')->select('nomor_soal')->first();

        $soal = new Soal($request->except('_token', 'files' , 'isi', 'audio', 'pilA', 'pilB', 'pilC', 'pilD', 'pilE')); 

        $konten = Summernote::saveContent($request->isi, 'soal');
        $konten = Purifier::clean($konten);

        $pilihanGanda = [
            'pilA' => $request->pilA, 
            'pilB' => $request->pilB, 
            'pilC' => $request->pilC, 
            'pilD' => $request->pilD, 
            'pilE' => $request->pilE
        ];

        $purified = Summernote::prosesPilihanGanda($pilihanGanda);

        $soal->pilA = $purified['pilA'];
        $soal->pilB = $purified['pilB'];
        $soal->pilC = $purified['pilC'];
        $soal->pilD = $purified['pilD'];
        $soal->pilE = $purified['pilE'];

        $soal->isi = $konten;
        $soal->jenis = $request->jenis;
        $soal->nomor_soal = $lastNumber ? $lastNumber->nomor_soal + 1 : 1;

        $soal->save();

        $audio = $request->file('audio');

        if($audio !== null) 
        {

            $filePath = HandleFile::upload($audio, config('enums.path.audio'));

            $konten = new Konten();

            $konten->soal_id = $soal->id;
            $konten->layout = 'bottom';
            $konten->isi = $filePath;
            $konten->type = 'audio';

            $konten->save();
        }

        return redirect()->route('banksoal.show', $request->bank_soal_id)->with('success', 'Berhasil menyimpan soal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $paket = $request->input('paket');

        $soal = $paket === null ? Soal::where('bank_soal_id', $id)->orderBy('nomor_soal')->get() :
            Soal::where('bank_soal_id', $id)->where('paket_id', $paket)->orderBy('nomor_soal')->get();

        $banksoal = BankSoal::find($id);

        return view('pages.soal.details', compact('soal', 'banksoal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal $soal)
    {
        $pilihanGanda = ['A' => 'A', 'B' => 'B'];

        if($soal->banksoal->opsi_pg >= 3) $pilihanGanda = array_merge($pilihanGanda,['C' => 'C']);
        if($soal->banksoal->opsi_pg >= 4) $pilihanGanda = array_merge($pilihanGanda, ['D' => 'D']);
        if($soal->banksoal->opsi_pg === 5) $pilihanGanda = array_merge($pilihanGanda, ['E' => 'E']);

        $pilihanGanda = array_merge(['' => 'Pilih Jawaban'], $pilihanGanda);

        return view('pages.soal.edit', compact('soal', 'pilihanGanda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SoalRequest $request, Soal $soal)
    {
        $content = Summernote::saveContent($request->isi);
        $content = Purifier::clean($content);

        $pilihanGanda = [
            'pilA' => $request->pilA, 
            'pilB' => $request->pilB, 
            'pilC' => $request->pilC, 
            'pilD' => $request->pilD, 
            'pilE' => $request->pilE
        ];

        $purified = Summernote::prosesPilihanGanda($pilihanGanda);

        $soal->pilA = $purified['pilA'];
        $soal->pilB = $purified['pilB'];
        $soal->pilC = $purified['pilC'];
        $soal->pilD = $purified['pilD'];
        $soal->pilE = $purified['pilE'];

        $soal->paket_id = $request->paket_id;
        $soal->bank_soal_id = $request->bank_soal_id;
        $soal->isi = $content;
        $soal->kunci_jawaban = $request->kunci_jawaban;

        $audio = $request->file('audio');

        if($audio !== null) 
        {
            $filePath = HandleFile::upload($audio, config('enums.path.audio'));

            $konten = new Konten();

            $konten->soal_id = $soal->id;
            $konten->layout = 'bottom';
            $konten->isi = $filePath;
            $konten->type = 'audio';

            $konten->save();
        }

        $soal->save();

        return redirect()->route('banksoal.show', $request->bank_soal_id)->with('success', 'Berhasil mengupdate soal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal $soal)
    {
        $banksoal = $soal->banksoal;

        if($soal->konten->count()) {
            foreach($soal->konten as $konten) {
                $deleteContent = $konten->type === 'image' ? HandleFile::delete($konten->isi, config('enums.path.image')) :
                    HandleFile::delete($konten->isi, config('enums.path.audio'));

                if(!$deleteContent) continue;

                $konten->delete();

            }            
        }

        $soal->delete();

        return redirect()->route('banksoal.show', $banksoal)->with('success', 'Berhasil menghapus soal');
    }
}
