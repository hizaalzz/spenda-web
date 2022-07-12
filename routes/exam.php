<?php

use Illuminate\Support\Facades\Route;

Route::get('/ujian/selesai', 'UjianController@ujianSelesai')->name('ujian.selesai');
Route::get('/ujian', 'UjianController@ujian')->name('ujian.mulai');
Route::post('/ujian/verifikasi', 'UjianController@verifikasiToken')->name('ujian.verifikasi');
Route::get('/persiapan', 'UjianController@persiapan')->name('ujian.persiapan');
Route::get('/akun', 'UjianController@showAccountInfo')->name('ujian.account');
