<?php

namespace App\Policies;

use App\Models\Konten;
use App\Models\Admin;
use App\Models\Soal;
use Illuminate\Auth\Access\HandlesAuthorization;

class KontenPolicy
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
     * @param  \App\Konten  $konten
     * @return mixed
     */
    public function view(Admin $user, Soal $soal)
    {
        return $user->can('lihat-entitas') || 
            $user->guru_id === $soal->jadwal->guru_id;
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
     * @param  \App\Konten  $konten
     * @return mixed
     */
    public function update(Admin $user, Konten $konten)
    {
        return $user->can('edit-soal');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Konten  $konten
     * @return mixed
     */
    public function delete(Admin $user, Konten $konten)
    {
        return $user->can('hapus-soal');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Konten  $konten
     * @return mixed
     */
    public function restore(Admin $user, Konten $konten)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Konten  $konten
     * @return mixed
     */
    public function forceDelete(Admin $user, Konten $konten)
    {
        return $user->hasRole('admin');
    }
}
