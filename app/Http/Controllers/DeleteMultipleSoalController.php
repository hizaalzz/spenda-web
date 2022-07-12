<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Soal;
use HandleFile;

class DeleteMultipleSoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'deleteCheck' => 'required'
        ]);

        $items = $request->input('deleteCheck');

        foreach($items as $item) {
            $soal = Soal::find($item);

            if(count($soal->konten)) {
                foreach($soal->konten as $konten) {
                    $deleteContent = $konten->type === 'image' ? HandleFile::delete($konten->isi, config('enums.path.image')) :
                        HandleFile::delete($konten->isi, config('enums.path.audio'));

                    if(!$deleteContent) continue;

                    $konten->delete();

                }            
            }

            $soal->delete();
        }

        return response('Berhasil menghapus beberapa soal');
    }
}
