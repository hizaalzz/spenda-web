<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guru;
use Auth;

class GuruMatapelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        
        // Only admin who can edit 
    }
    
    public function addMatapelajaran($id, Request $request) 
    {
        $this->validate($request, [
            'matapelajaran' => 'required',
        ]);

        $guru = Guru::findOrFail($id);

        //add matapelajaran
        
        $guru->matapelajaran()->attach($request->matapelajaran);

        return redirect()->route('guru.edit', $id)->with('success', 'Berhasil menambahkan matapelajaran');
    }


    public function removeMatapelajaran($id, Request $request)
    {
        $this->validate($request, [
            'matapelajaran' => 'required',
        ]);

        $guru = Guru::findOrFail($id);

        //Remove all matapelajaran first

        foreach($request->matapelajaran as $matapelajaran) {
            $guru->matapelajaran()->detach($matapelajaran);
        }
        
        return redirect()->route('guru.edit', $id)->with('success', 'Berhasil menghapus matapelajaran');
    }
}
