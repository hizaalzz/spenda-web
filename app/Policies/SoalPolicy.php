<?php

namespace App\Policies;

use App\Models\Soal;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SoalPolicy
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
     * @param  \App\Soal  $soal
     * @return mixed
     */
    public function view(Admin $user, Soal $soal)
    {
        return $user->hasRole('admin') || 
            $user->can('lihat-entitas') && $user->guru_id === $soal->banksoal->guru_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $user->can('buat-soal');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Soal  $soal
     * @return mixed
     */
    public function update(Admin $user, Soal $soal)
    {
        return $user->hasRole('admin') || 
            $user->can('edit-soal') && $user->guru_id === $soal->banksoal->guru_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Soal  $soal
     * @return mixed
     */
    public function delete(Admin $user, Soal $soal)
    {
        return $user->hasRole('admin') || 
            $user->can('hapus-soal') && $user->guru_id === $soal->banksoal->guru_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Soal  $soal
     * @return mixed
     */
    public function restore(Admin $user, Soal $soal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Soal  $soal
     * @return mixed
     */
    public function forceDelete(Admin $user, Soal $soal)
    {
        //
    }
}
