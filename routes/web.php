<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthAdmin\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Auth::routes(['register' => false, 'logout' => false]);
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('admin')->group(function() {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

Route::get('/home', 'HomeController@index')->name('home');

// Route::prefix('admin')->group(function() {
//     Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [LoginController::class, 'login']);
//     Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
// });

Route::resource('/murid', 'MuridController');
Route::resource('/guru', 'GuruController');
Route::resource('/manage/admin', 'AdminController')->except(['edit', 'update', 'store', 'show']);
Route::resource('/matapelajaran', 'MatapelajaranController')->except(['show']);
Route::resource('/tingkat', 'JurusanController');
Route::resource('/pengumuman', 'PengumumanController');
Route::resource('/level', 'LevelController')->except(['show']);
Route::resource('/class', 'KelasController');
Route::resource('/sesi', 'SesiController')->except(['show']);
Route::resource('/soal', 'SoalController');
Route::resource('/paket', 'PaketController')->except(['show']);
Route::resource('/konten', 'KontenController')->except('index');
Route::resource('/penilaian', 'PenilaianController')->only(['index', 'show']);
Route::resource('/banksoal', 'BankSoalController');
Route::resource('/jenisujian', 'JenisUjianController')->except('show');

Route::resource('/nilai', 'NilaiController')->only(['show', 'update']);
Route::get('/nilai/{idMurid}/jadwal/{idJadwal}', 'NilaiController@edit')->name('nilai.edit');

Route::post('/nilai/pg/simpan', 'NilaiPilihanGandaOtomatisController')->name('nilai.pg.otomatis');

Route::post('/change/password', 'ChangePasswordController')->name('change.password');
Route::post('/change/murid/password', 'ChangeMuridPasswordController')->name('change.murid.password');

Route::get('/jawaban/{murid}/jadwal/{jadwal}', 'JawabanController@show')->name('jawaban.show');
Route::get('/jawaban/{id}', 'JawabanController@searchById')->name('jawaban.find');
Route::post('/jawaban/store', 'JawabanController@saveStatus')->name('jawaban.store');

Route::get('/upload/soal', 'UploadSoalController@uploadView')->name('soal.upload');
Route::post('/upload/soal', 'UploadSoalController@upload')->name('upload.soal');

Route::resource('/soal', 'SoalController')->except(['index', 'show']);
Route::delete('/delete/soal', 'DeleteMultipleSoalController')->name('soal.delete.multiple');
Route::resource('/kelasmurid', 'KelasMuridController');

Route::resource('/ruangan', 'RuanganController')->except('show');
Route::resource('/jadwal', 'JadwalController');

Route::post('/jurusan/{jurusan}/pelajaran/delete', 'DeleteMataPelajaranController')->name('matapelajaran.delete');
Route::post('/jurusan/{jurusan}/pelajaran/tambah', 'TambahMataPelajaranController')->name('matapelajaran.add');

// Ajax route get
Route::prefix('get')->group(function() {
    Route::get('/kelas/matapelajaran', 'SingleDataController@getMatapelajaranFromKelas')->name('matapelajaran.findby.kelas');
    Route::get('/jurusan/matapelajaran', 'SingleDataController@getMatapelajaranFromJurusan')->name('matapelajaran.findby.jurusan');
    Route::get('/guru/matapelajaran', 'SingleDataController@getGuruFromMatapelajaran')->name('guru.findby.matapelajaran');
    Route::get('/soal/id', 'SingleDataController@getSoalById')->name('soal.findby.id');
    Route::get('/matapelajaran/banksoal', 'SingleDataController@getBankSoalFromMatapelajaran')->name('banksoal.findby.matapelajaran');
    Route::get('/kelas/siswa', 'SingleDataController@getMuridFromKelas')->name('murid.findby.kelas');
});

Route::post('/class/{kelas}/murid/delete', 'DeleteMuridController')->name('murid.delete');
Route::post('/class/{kelas}/murid/tambah', 'TambahMuridController')->name('murid.add');

Route::post('/dropzone/store', 'DropzoneController@store')->name('dropzone.store');

Route::prefix('pelaksanaan')->group(function() {
    Route::get('/kelas', 'PelaksanaanController@index')->name('pelaksanaan.kelas');
    Route::get('/kelas/{kelas}', 'PelaksanaanController@show')->name('pelaksanaan.details');

    Route::get('/kelas/{kelas}/create', 'PelaksanaanController@create')->name('pelaksanaan.create');
    Route::post('/kelas/{kelas}', 'PelaksanaanController@store')->name('pelaksanaan.store');

    Route::get('/{pelaksanaan}/edit', 'PelaksanaanController@edit')->name('pelaksanaan.edit');
    Route::put('/{pelaksanaan}/edit', 'PelaksanaanController@update')->name('pelaksanaan.update');

    Route::delete('/{pelaksanaan}/delete', 'PelaksanaanController@destroy')->name('pelaksanaan.destroy');

});


Route::prefix('aktivasi')->group(function() {
    Route::get('/', 'AktivasiUjianController@index')->name('aktivasi.index');
    Route::post('/', 'AktivasiUjianController@activate')->name('aktivasi.aktifkan');
    Route::get('/gettoken', 'AktivasiUjianController@getToken')->name('aktivasi.gettoken');
    Route::post('/update/{status}', 'AktivasiUjianController@updateStatus')->name('aktivasi.update');
    Route::delete('/delete/{status}', 'AktivasiUjianController@delete')->name('aktivasi.delete');
});

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings', 'SettingsController@saveOrUpdate')->name('settings.store');

Route::prefix('export')->group(function() {
    Route::get('/nilai/murid/{id}', 'PdfExportController@createRaport')->name('export.pdf');
    Route::post('/multiple', 'PdfExportController@createMultipleRaport')->name('export.pdf.multiple');
    Route::get('/multiple', 'PdfExportController@viewExport');
});

Route::get('/aktivitas', 'LogsController@index')->name('log.index');
Route::delete('/aktivitas/delete', 'LogsController@destroy')->name('log.destroy');

Route::get('/importdata', 'ImportFromExcelController@index')->name('import.index');
Route::post('/importdata/excel', 'ImportFromExcelController@importData')->name('import.store');

Route::post('/gurumapel/{id}/add', 'GuruMatapelajaranController@addMatapelajaran')->name('gurumapel.store');
Route::delete('/gurumapel/{id}/remove', 'GuruMatapelajaranController@removeMatapelajaran')->name('gurumapel.remove');
