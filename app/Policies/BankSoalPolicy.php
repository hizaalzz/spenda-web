<?php

namespace App\Policies;

use App\Models\BankSoal;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankSoalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(Admin $user)
    {
        return $user->hasRole('admin') || $user->hasRole('guru');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\App\BankSoal  $bankSoal
     * @return mixed
     */
    public function view(Admin $user, BankSoal $bankSoal)
    {
        return $user->hasRole('admin') || 
            $user->can('lihat-entitas') && $bankSoal->guru_id === $user->guru_id;
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
     * @param  \App\App\BankSoal  $bankSoal
     * @return mixed
     */
    public function update(Admin $user, BankSoal $bankSoal)
    {
        return $user->can('edit-soal') && $bankSoal->guru_id === $user->guru_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\App\BankSoal  $bankSoal
     * @return mixed
     */
    public function delete(Admin $user, BankSoal $bankSoal)
    {
        return $user->can('hapus-soal') && $bankSoal->guru_id === $user->guru_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\App\BankSoal  $bankSoal
     * @return mixed
     */
    public function restore(Admin $user, BankSoal $bankSoal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\App\BankSoal  $bankSoal
     * @return mixed
     */
    public function forceDelete(Admin $user, BankSoal $bankSoal)
    {
        //
    }
}
