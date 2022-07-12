<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\LevelDataTable;
use App\Http\Requests\LevelRequest;
use App\Models\Level;

class LevelController extends Controller
{
    public $skala;
    
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Level::class, 'level');

        $this->skala = collect([
            1 => 1,
            2 => 2,
            3 => 3
        ]);

        $this->skala->prepend('Pilih skala', '');
    }

    public function index(LevelDataTable $dataTable)
    {
        return $dataTable->render('pages.level.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('pages.level.create', ['skala' => $this->skala]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelRequest $request)
    {
        $level = new Level($request->except('_token'));

        $level->save();

        return redirect()->route('level.index')->with('success', 'Berhasil menambahkan level');
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
    public function edit(Level $level)
    {
        return view('pages.level.edit', compact('level'))->with('skala', $this->skala);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LevelRequest $request, Level $level)
    {
        $level->update([
            'nama' => $request->nama,
            'skala' => $request->skala
        ]);

        return redirect()->route('level.index')->with('success', 'Berhasil mengupadate level');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('level.index')->with('success', 'Berhasil menghapus level');
    }
}
