<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Guru;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuruPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(Admin $user)
    {
        return $user->can('lihat-semua-entitas');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guru  $guru
     * @return mixed
     */
    public function view(Admin $user, Guru $guru)
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
     * @param  \App\Guru  $guru
     * @return mixed
     */
    public function update(Admin $user, Guru $guru)
    {
        return $user->can('edit-entitas') || $user->guru_id === $guru->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guru  $guru
     * @return mixed
     */
    public function delete(Admin $user, Guru $guru)
    {
        return $user->can('hapus-entitas');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guru  $guru
     * @return mixed
     */
    public function restore(Admin $user, Guru $guru)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guru  $guru
     * @return mixed
     */
    public function forceDelete(Admin $user, Guru $guru)
    {
        return $user->hasRole('admin');
    }
}
