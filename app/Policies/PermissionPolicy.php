<?php

namespace App\Policies;

use App\Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;



    public function index(User $user)
    {
        return $user->has_permission('index-permission');
    }
    public function view(User $user, Permission $permission)
    {
        return $user->has_permission('view-permission');
    }
    public function create(User $user)
    {
        return $user->has_permission('create-permission');
    }
    public function update(User $user, Permission $permission)
    {
        return $user->has_permission('update-permission');
    }
    public function delete(User $user, Permission $permission)
    {
        return $user->has_permission('delete-permission');
    }
    public function restore(User $user, Permission $permission)
    {
        //
    }
    public function forceDelete(User $user, Permission $permission)
    {
        //
    }
}
