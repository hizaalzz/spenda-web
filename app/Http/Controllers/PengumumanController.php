<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PengumumanRequest;
use App\DataTables\PengumumanDataTable;
use App\Models\Pengumuman;
use Summernote;
use Purifier;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Pengumuman::class, 'pengumuman');   
    }

    public function index(PengumumanDatatable $dataTable)
    {
        return $dataTable->render('pages.pengumuman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengumumanRequest $request)
    {
        $pengumuman = new Pengumuman();

        $content = Summernote::saveContent(Purifier::clean($request->konten, array('HTML.Allowed' => 
            'div,b,strong,i,em,u,ul,ol,li,p[style],br,span[style],img[width|height|alt|src]')));
        
        $pengumuman->judul = $request->judul;
        $pengumuman->konten = $content;
        $pengumuman->jenis = $request->jenis;

        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('message.success', 'Berhasil Menyimpan pengumuman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('pages.pengumuman.details', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('pages.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengumumanRequest $request, Pengumuman $pengumuman)
    {
        $pengumuman->judul = $request->judul;
        $pengumuman->konten = Summernote::saveContent($request->konten);
        $pengumuman->jenis = $request->jenis;

        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil mengupdate pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil menghapus pengumuman');
    }
}
