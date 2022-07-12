<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\PaketDataTable;
use App\Http\Requests\PaketRequest;
use App\Models\Jadwal;
use App\Models\Paket;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Paket::class, 'paket');    
    }

    public function index(PaketDataTable $dataTable)
    {
        return $dataTable->render('pages.paket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.paket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaketRequest $request)
    {
        $paket = new Paket($request->except('_token'));

        $paket->save();

        return redirect()->route('paket.index')->with('success', 'Berhasil menyimpan paket');
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
    public function edit(Paket $paket)
    {
        return view('pages.paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaketRequest $request, Paket $paket)
    {
        $paket->update([
            'kode_soal' => $request->kode_soal
        ]);

        return redirect()->route('paket.index')->with('success', 'Berhasil mengupdate paket');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Berhasil menghapus paket');

    }
}
