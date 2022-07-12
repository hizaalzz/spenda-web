<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jurusan;

class DeleteMataPelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');    
    }

    public function __invoke(Jurusan $jurusan, Request $request)
    {
        $jurusan->matapelajaran()->detach($request->matapelajaran_id);

        return redirect()->back()->with('success', 'Berhasil menghapus');
    }
}
