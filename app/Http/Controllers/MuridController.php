<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Murid;
use HandleFile;
use App\DataTables\MuridDataTable;
use App\Http\Requests\MuridRequest;

class MuridController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');    
        $this->authorizeResource(Murid::class, 'murid');
    }
    
    public function index(MuridDataTable $dataTable)
    {
        return $dataTable->render('pages.murid.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.murid.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MuridRequest $request)
    {
        //Create murid
        $murid = new Murid($request->except('_token', 'fotomurid'));

        $fotoMurid = $request->file('fotomurid');

        if($fotoMurid !== null) 
        {
            $resizedImage = HandleFile::resizeAndSaveImage($fotoMurid, config('enums.path.fotomurid'));

            $murid->foto = $resizedImage;
        }

        $murid->save();


        return redirect()->route('murid.index')->with('success', 'Berhasil Menambah Murid');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Murid $murid)
    {
        return view('pages.murid.details', compact('murid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Murid $murid)
    {
        return view('pages.murid.edit', compact('murid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MuridRequest $request, Murid $murid)
    {
        $murid->nama = $request->nama;
        $murid->nisn = $request->nisn;
        $murid->nis = $request->nis;
        $murid->jenis_kelamin = $request->jenis_kelamin;
        $murid->tempat_lahir = $request->tempat_lahir;
        $murid->tanggal_lahir = $request->tanggal_lahir;
        $murid->telp = $request->telp;

        $fotoMurid = $request->file('fotomurid');
        
        if($fotoMurid !== null) 
        {
             // Delete old photo first
             if(HandleFile::hasFile(config('enums.path.fotomurid') . '/' . $murid->foto)) 
             {
                 HandleFile::delete($murid->foto, config('enums.path.fotomurid'));
             }
 
             $resizedImage = HandleFile::resizeAndSaveImage($fotoMurid, config('enums.path.fotomurid'));
 
             $murid->foto = $resizedImage;
 
        }

        $murid->save();

        $user = User::where('murid_id', $murid->id)->first();
        $user->nama = $request->nama;

        $user->save();

        return redirect()->route('murid.index')->with('success', 'Berhasil Mengupdate Murid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Murid $murid)
    {
        $user = $murid->user;

        if($user !== null && $user->delete()) 
        {
            // Delete photo 
            HandleFile::delete($murid->foto, config('enums.path.fotomurid'));

            $murid->delete();
        }

        try {
            $murid->delete();
        } catch(\Exception $ex) {
            return redirect()->back()->withErrors('Gagal menghapus murid');
        }

        return redirect()->route('murid.index')->with('success', 'Berhasil Menghapus Murid');

    }
}
