<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\SesiDataTable;
use App\Http\Requests\SesiRequest;
use App\Models\Sesi;

class SesiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Sesi::class, 'sesi');    
    }

    public function index(SesiDataTable $dataTable)
    {
        return $dataTable->render('pages.sesi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sesi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SesiRequest $request)
    {
        $sesi = new Sesi($request->except('_token'));

        $sesi->save();

        return redirect()->route('sesi.index')->with('success', 'Berhasil menambahkan sesi');
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
    public function edit(Sesi $sesi)
    {
        return view('pages.sesi.edit', compact('sesi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SesiRequest $request, Sesi $sesi)
    {
        $sesi->update([
            'nama' => $request->nama,
            'start' => $request->start,
            'end' => $request->end
        ]);

        return redirect()->route('sesi.index')->with('success', 'Berhasil mengupdate sesi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sesi $sesi)
    {
        $sesi->delete();

        return redirect()->route('sesi.index')->with('success', 'Berhasil menghapus sesi');
    }
}
