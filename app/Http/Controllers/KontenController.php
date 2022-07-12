<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use HandleFile;
use App\Models\Konten;
use App\Models\Soal;

class KontenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->authorizeResource(Konten::class, 'konten');    
    }

    public function index(Request $request)
    {
        //
    }

    public function create(Request $request)
    {
        if(!$request->has('soal')) return redirect()->back()->withErrors('Soal belum dipilih');

        $soal = Soal::find($request->soal);

        return view('pages.konten.create', compact('soal'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $soal = Soal::with('konten')->find($id);

        return view('pages.konten.details', compact('soal'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Konten $konten)
    {
        // Delete file first
        $deleteFile = HandleFile::delete(config('enums.path.imageSoal'), $konten->isi);

        if(!$deleteFile) return redirect()->route('banksoal.index')->withErrors('Gagal menghapus konten/media');
        
        $konten->delete();

        return redirect()->route('banksoal.index')->with('success', 'Berhasil menghapus konten');
    }
}
