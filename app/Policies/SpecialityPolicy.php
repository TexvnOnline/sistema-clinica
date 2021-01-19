<?php

namespace App\Policies;

use App\Speciality;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Speciality  $speciality
     * @return mixed
     */
    public function view(User $user, Speciality $speciality)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->has_role(config('app.admin_role'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Speciality  $speciality
     * @return mixed
     */
    public function update(User $user, Speciality $speciality)
    {
        return $user->has_role(config('app.admin_role'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Speciality  $speciality
     * @return mixed
     */
    public function delete(User $user, Speciality $speciality)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Speciality  $speciality
     * @return mixed
     */
    public function restore(User $user, Speciality $speciality)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Speciality  $speciality
     * @return mixed
     */
    public function forceDelete(User $user, Speciality $speciality)
    {
        //
    }
}
