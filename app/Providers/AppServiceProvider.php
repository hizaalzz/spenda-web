<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Guru;
use App\Models\Sesi;
use App\Models\Kelas;
use App\Models\Paket;
use App\Models\Level;
use App\Models\Ruangan;
use App\Models\Jurusan;
use App\Models\Settings;
use App\Models\Matapelajaran;
use App\Http\View\Composers\SettingsComposer;
use App\View\Components\ContentDisplay;
use App\View\Components\SoalDisplay;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('soal-display', SoalDisplay::class);
        Blade::component('content-display', ContentDisplay::class);

        if($this->app->environment('production')) {
            \URL::forceScheme('https');

            $this->app['request']->server->set('HTTPS', true);
        }
        
        view()->composer(['pages.jadwal.*', 'pages.soal.index'], function($view) {
            $view->with('kelas', Kelas::pluck('nama_kelas', 'id')->prepend('Pilih Kelas', ''));
        });

        view()->composer(['pages.soal.*', 'pages.banksoal.details', 'pages.pelaksanaan.create'], function($view) {
            $view->with('paket', Paket::pluck('kode_soal', 'id')->prepend('Pilih kode soal', ''));
        });

        view()->composer(['pages.pelaksanaan.create'], function($view) {
            $view->with('ruangan', Ruangan::pluck('nama', 'id')->prepend('Pilih Ruangan', ''));
            $view->with('sesi', Sesi::pluck('nama', 'id')->prepend('Pilih Sesi', ''));
        });

        view()->composer(['pages.banksoal.create', 'pages.banksoal.edit'], function($view) {
            $view->with('level', Level::pluck('nama', 'id')->prepend('Pilih level', ''));
            $view->with('jurusan', Jurusan::pluck('nama', 'id')->prepend('Pilih Tingkat Kelas', ''));
            $view->with('matapelajaran', Matapelajaran::pluck('nama', 'id')->prepend('Pilih matapelajaran', ''));
        });

        view()->composer(['pages.settings', 'pages.ujian.dashboardujian'], SettingsComposer::class);
    }
}
