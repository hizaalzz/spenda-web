<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Matapelajaran;
use App\Models\Guru;
use App\Models\Admin;
use HandleFile;
use App\Classes\GenerateCredential;
use App\DataTables\GuruDataTable;
use App\Http\Requests\GuruRequest;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Guru::class, 'guru');
    }

    public function index(GuruDataTable $dataTable)
    {
        return $dataTable->render('pages.guru.index');
    }

    public function create()
    {
        $listMatapelajaran = Matapelajaran::select('id', 'nama')->get();

        $guru = Guru::whereNotIn('nama', ['admin'])->select(['id', 'nama', 'jenis_kelamin'])->get();

        return view('pages.guru.create', compact('guru', 'listMatapelajaran'));
    }

    public function store(GuruRequest $request)
    {
        $superadmin = $request->input('superadmin', false);

        $password = $request->input('password', null);

        if($superadmin && Auth::guard('admin')->check() != true) {
            return redirect('guru.index')->withErrors('Terjadi kesalahan saat menyimpan data guru');
        }

        $guru = new Guru();

        $guru->nuptk = $request->nuptk;
        $guru->nama = $request->nama;
        $guru->email = $request->email;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->telp = $request->telp;

        $fotoGuru = $request->file('fotoguru');

        if($request->fotoguru !== null) 
        {
            $resizedImage = HandleFile::resizeAndSaveImage($fotoGuru, config('enums.path.fotoguru'));

            $guru->foto = $resizedImage;

        }

        if($guru->save())
        {
            $adminGenerator = new GenerateCredential();

            $adminGenerator->generateAdmin($guru, $superadmin, $password);

            if($request->has('matapelajaran') && $request->matapelajaran !== null && $request->matapelajaran !== []) {
                foreach($request->matapelajaran as $matapelajaran) {
                    $guru->matapelajaran()->attach($matapelajaran);
                }
            }

        }
        
        return redirect()->route('guru.index')->with('success', 'Berhasil Menyimpan Guru');
    }

    public function show(Guru $guru)
    {
        return view('pages.guru.details', compact('guru'));
    }

    public function edit(Guru $guru)
    {
        $listMatapelajaran = Matapelajaran::pluck('nama', 'id')->prepend('Pilih mata pelajaran', '');

        return view('pages.guru.edit', compact('guru', 'listMatapelajaran'));
    }

    public function update(GuruRequest $request, Guru $guru)
    {  
        $guru->nama = $request->nama;
        $guru->nuptk = $request->nuptk;
        $guru->email = $request->email;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->telp = $request->telp;

        $fotoGuru = $request->file('fotoguru');

        if($request->fotoguru !== null) 
        {
            // Delete old photo first
            if(HandleFile::hasFile(config('enums.path.fotoguru') . '/' . $guru->foto)) 
            {
                HandleFile::delete($guru->foto, config('enums.path.fotoguru'));
            }

            $resizedImage = HandleFile::resizeAndSaveImage($fotoGuru, config('enums.path.fotoguru'));

            $guru->foto = $resizedImage;

        }

        $guru->save();
        
        $admin = Admin::where('guru_id', $guru->id)->first();
        $admin->nama = $request->nama;

        $admin->save();

        return redirect()->route('guru.index')->with('success', 'Berhasil Mengupdate Guru');
    }

    public function destroy(Guru $guru)
    {
        $admin = $guru->admin;

        if($admin->id === 1) return redirect()->route('admin.index')->withErrors('Tidak dapat menghapus akun default');

        if($admin !== null && $admin->delete()) 
        {
            $fotoGuru = $guru->foto;

            if($guru->delete()) 
            {
                if(HandleFile::hasFile(config('enums.path.fotoguru') . '/' . $fotoGuru)) 
                {
                    HandleFile::delete($fotoGuru, config('enums.path.fotoguru'));
                }
            }


            return redirect()->route('guru.index')->with('success', 'Berhasil Menghapus Guru');
        }

        return redirect()->back()->withErrors('Gagal menghapus guru');
    }
}
