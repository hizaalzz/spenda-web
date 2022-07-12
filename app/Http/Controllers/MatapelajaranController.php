<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\MatapelajaranDataTable;
use App\Http\Requests\MatapelajaranRequest;
use App\Models\Guru;
use App\Models\Matapelajaran;

class MatapelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Matapelajaran::class, 'matapelajaran');
    }

    public function index(MatapelajaranDataTable $dataTable)
    {        
        return $dataTable->render('pages.matapelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::whereHas('admin', function($query) {
            $query->where('superadmin', false);
        })->paginate(10);

        return view('pages.matapelajaran.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatapelajaranRequest $request)
    {
        $matapelajaran = new Matapelajaran();
        $matapelajaran->nama = $request->nama;
        
        $matapelajaran->save();

        return redirect()->route('matapelajaran.index')->with('success', 'Berhasil menambahkan mata pelajaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Matapelajaran $matapelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Matapelajaran $matapelajaran)
    {
        return view('pages.matapelajaran.edit', compact('matapelajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatapelajaranRequest $request, Matapelajaran $matapelajaran)
    {
        $matapelajaran->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('matapelajaran.index')->with('success', 'Berhasil mengupdate mata pelajaran');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matapelajaran $matapelajaran)
    {
        $matapelajaran->delete();
        
        return redirect()->route('matapelajaran.index')->with('success', 'Berhasil menghapus matapelajaran');
    }
}
