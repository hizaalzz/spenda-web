<?php

use Illuminate\Support\Facades\Route;

Route::get('storage/images/{filename}', function($filename) {
    $path = storage_path('public/images/' . $filename);

    return HandleFile::hasFile($path) ? HandleFile::getFile($path) : abort(404);
});

Route::get('storage/images/soal/{filename}', function($filename) {
    $path = storage_path('public/images/soal/' . $filename);

    return HandleFile::hasFile($path) ? HandleFile::getFile($path) : abort(404);
});

Route::get('storage/audio/{filename}', function($filename) {
    $path = storage_path('public/audio/' . $filename);

    return HandleFile::hasFile($path) ? HandleFile::getFile($path) : abort(404);
});

Route::get('storage/murid/foto/{filename}', function($filename) {
    $path = storage_path('public/murid/foto/' . $filename);

    return HandleFile::hasFile($path) ? HandleFile::getFile($path) : abort(404);
});

Route::get('storage/guru/foto/{filename}', function($filename) {
    $path = storage_path('public/guru/foto/' . $filename);

    return HandleFile::hasFile($path) ? HandleFile::getFile($path) : abort(404);
});