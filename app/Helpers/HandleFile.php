<?php 

namespace App\Helpers;

use Image;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class HandleFile {

    public static function upload($file, $path) 
    {
        $filename = Self::generateFileName($file);

        $path = $file->storeAs($path, $filename);
    
        return basename($path);
    }

    public static function generateFileName($file) 
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

        $clientFileName = uniqid() . '.' . \File::extension($file->getClientOriginalName());
        $filename = $date->timestamp .  '-' . $clientFileName;

        return $filename;

    }

    public static function delete($filename, $path) 
    {
        try {
            unlink(url( '/'));

            return true;
        } catch(Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getFile($path) 
    {
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public static function resizeAndSaveImage($image, $pathToSave)
    {
        $filename = Self::generateFileName($image);

        $img = Image::make($image->path());
        
        $img->fit(151, 226);

        $img->resize(151, 226, function($constraint) {
            $constraint->upsize();
        });

        $canvas = Image::canvas(151, 226);
        $canvas->insert($img, 'center');

        $encode = $canvas->encode('jpg')->getEncoded();

        Storage::put($pathToSave . '/' . $filename, $encode);

        return $filename;
    }

    public static function hasFile($path) 
    {
        return Storage::disk('local')->exists($path) ? true : false;
    }
}