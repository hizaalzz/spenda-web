<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Murid;

class TambahMuridController extends Controller
{
    public function __invoke(Request $request)
    {
        $murid = $request->input('murid_id', null);

        if($murid == null) 
        {
            return redirect()->route('murid.index')->withErrors('Murid belum dipilih');
        }

        foreach($murid as $item) 
        {
            $murid_entry = Murid::findOrFail($item);

            $murid_entry->kelas_id = $request->route('kelas');
            $murid_entry->save();
        }

        return redirect()->route('murid.index')->with('success', 'Berhasil menambahkan murid ke kelas');
    }
}
