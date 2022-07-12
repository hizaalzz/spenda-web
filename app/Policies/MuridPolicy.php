<?php

namespace App\Policies;

use App\Models\Murid;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class MuridPolicy
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
     * @param  \App\Murid  $murid
     * @return mixed
     */
    public function view(Admin $user, Murid $murid)
    {
        return $user->can('lihat-entitas') || $user->hasRole('guru');
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
     * @param  \App\Murid  $murid
     * @return mixed
     */
    public function update(Admin $user, Murid $murid)
    {
        return $user->can('edit-entitas');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Murid  $murid
     * @return mixed
     */
    public function delete(Admin $user, Murid $murid)
    {
        return $user->can('hapus-entitas');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Murid  $murid
     * @return mixed
     */
    public function restore(Admin $user, Murid $murid)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Murid  $murid
     * @return mixed
     */
    public function forceDelete(Admin $user, Murid $murid)
    {
        return $user->hasRole('admin');
    }
}
