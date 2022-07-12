<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\RuanganDataTable;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Ruangan::class, 'ruangan');    
    }

    public function index(RuanganDataTable $dataTable)
    {
        return $dataTable->render('pages.ruangan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Ruangan::class);

        $this->validate($request, [
            'nama' => 'required|unique:ruangan'
        ]);

        $ruangan = new Ruangan($request->except('_token'));

        $ruangan->save();

        return redirect()->route('ruangan.index')->with('success', 'Berhasil menambahkan ruangan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        return view('pages.ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $this->authorize('edit', $ruangan);

        $this->validate($request, [
            'nama' => 'required'
        ]);
        
        $ruangan->update([
            'nama' => $request->nama
        ]);

        $ruangan->save();

        return redirect()->route('ruangan.index')->with('success', 'Berhasil mengupdate ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        $this->authorize('delete', $ruangan);

        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Berhasil menghapus ruangan');

    }
}
