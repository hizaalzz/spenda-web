<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Murid;

class DeleteMuridController extends Controller
{
    public function __invoke(Request $request)
    {
        $murid = $request->input('murid_id');

        if($murid == null) 
        {
            return redirect()->route('murid.index')->withErrors('Murid belum dipilih');
        }

        foreach($murid as $item) 
        {
            $murid_entry = Murid::findOrFail($item);

            $murid_entry->kelas_id = null;
            $murid_entry->save();
        }

        return redirect()->back()->with('success', 'Berhasil menghapus murid dari kelas');
    }
}
