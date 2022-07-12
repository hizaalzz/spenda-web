<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jurusan;

class TambahMataPelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');   
    }

    public function __invoke(Jurusan $jurusan, Request $request)
    {
        $matapelajaran = $request->input('matapelajaran', null);

        if($matapelajaran == null) {
            return redirect()->route('jurusan.index')->withErrors('Matapelajaran belum dipilih');
        }

        foreach($matapelajaran as $pelajaran) {
            $jurusan->matapelajaran()->attach($pelajaran);
        }

        return redirect()->route('jurusan.index')->with('success', 'Berhasil menambahkan matapelajaran');
    }
}
