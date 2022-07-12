<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(Admin $user)
    {
        return $user->can('lihat-semua-entitas') || $user->hasRole('admin');
    }

    public function view(Admin $user, Admin $admin)
    {
        return $user->can('lihat-entitas') || $user->guru_id === $admin->guru_id;
    }

    public function create(Admin $user)
    {
        return $user->can('buat-entitas');
    }

    public function update(Admin $user, Admin $admin)
    {
        return $user->can('edit-entitas') || $user->guru_id === $admin->guru_id;
    }

    public function delete(Admin $user, Admin $admin)
    {
        return $user->can('hapus-entitas');
    }

    public function restore(User $user, Admin $admin)
    {
        //
    }

    public function forceDelete(User $user, Admin $admin)
    {
        //
    }
}
