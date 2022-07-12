<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Murid;
use App\Policies\MuridPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Murid' => 'App\Policies\MuridPolicy',
        'App\Models\Guru' => 'App\Policies\GuruPolicy',
        'App\Models\Matapelajaran' => 'App\Policies\MatapelajaranPolicy',
        'App\Models\Jurusan' => 'App\Policies\JurusanPolicy',
        'App\Models\Kelas' => 'App\Policies\KelasPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Soal' => 'App\Policies\SoalPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
