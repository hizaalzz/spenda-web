<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Jadwal;
use Illuminate\Auth\Access\HandlesAuthorization;

class JadwalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(Admin $user)
    {
        return $user->can('lihat-semua-entitas') || $user->hasRole('guru');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function view(Admin $user, Jadwal $jadwal)
    {
        return $user->can('lihat-entitas');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $user->can('buat-entitas');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function update(Admin $user, Jadwal $jadwal)
    {
        return $user->can('edit-entitas');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function delete(Admin $user, Jadwal $jadwal)
    {
        return $user->can('hapus-entitas');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function restore(Admin $user, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function forceDelete(Admin $user, Jadwal $jadwal)
    {
        //
    }
}
