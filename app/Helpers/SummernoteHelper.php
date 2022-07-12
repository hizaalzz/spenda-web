<?php 

namespace App\Helpers;

use Purifier;
use DOMDocument;
use Carbon\Carbon;

class SummernoteHelper {
    public static function saveContent($content, $contentType = null) {

        $dom = new DOMDocument();

        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        $images = $dom->getElementsByTagName('img');
        
        foreach($images as $image) {
            $data = $image->getAttribute('src');

            if(strpos($data, ';') !== false) {

                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);

                $filename = Carbon::now()->format('d-m-Y-h-i-s') . '-' . uniqid() . '.png';

                if($contentType === 'soal') {
                    $path = public_path() .'/storage/images/soal/'. $filename;
                } else {
                    $path = public_path() .'/storage/images/'. $filename;

                }

                file_put_contents($path, $data);

                $image->removeAttribute('src');

                if($contentType === 'soal') {
                    $image->setAttribute('src', url('/storage/images/soal/') . '/' . $filename);
                } else {
                    $image->setAttribute('src', url('/storage/images/') . '/' . $filename);
                }
            }
        
        }

        return $dom->saveHTML();

    }

    public static function prosesPilihanGanda($data) 
    {

        return array_map(function($item) {
            if($item !== null) {
                $item = Self::saveContent($item, 'soal');
                $item = Purifier::clean($item);
            }         

            return $item;

        }, $data);
    }
}