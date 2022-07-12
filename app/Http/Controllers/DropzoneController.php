<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Konten;
use HandleFile;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DropzoneController extends Controller
{
    public function store(Request $request) 
    {
        $this->validate($request, [
            'layout' => 'required|in:top,bottom',
            'soal_id' => 'required|numeric',
            'file' => 'required|mimes:wav,mp3,amr,png,jpeg,jpg,gif,svg'
        ]);

        $files = $request->file('file');

        if(!is_array($files)) {
            $files = [$files];
        }

        if($files != null) 
        {
            foreach($files as $file) {

                $mime = $file->getClientMimeType();

                $konten = new Konten();
                
                if(stripos($mime, 'image') !== false) {
                    $baseName = HandleFile::upload($file, config('enums.path.imageSoal'));

                    $konten->type = 'image'; 
                }

                if(stripos($mime, 'audio') !== false) {
                    $baseName = HandleFile::upload($file, config('enums.path.audio'));

                    $konten->type = 'audio';
                }

                $konten->soal_id = $request->soal_id;
                $konten->layout = $request->layout;
                $konten->isi = $baseName;

                $konten->save();

            } 
            
        }

        return 'success';
    }
}
