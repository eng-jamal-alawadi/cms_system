<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function before( $admin ,$ability){
        if($admin->hasRole('Super-Admin')){
            return true;
        }
    }
    public function viewAny(  $user)
    {
        return $user->hasPermissionTo('Read-Cities')
        ? $this->allow()
        : $this->deny('You can not view any city');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(  $user, City $city)
    {
        return $user->hasPermissionTo('Read-Cities')
        ? $this->allow()
        : $this->deny('You can not view this city');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(   $user)
    {
        return $user->hasPermissionTo('Create-Cities')
        ? $this->allow()
        : $this->deny('You can not create a city');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(  $user, City $city)
    {
        return $user->hasPermissionTo('Update-Cities')
        ? $this->allow()
        : $this->deny('You can not update this city');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( $user, City $city)
    {
        return $user->hasPermissionTo('Delete-Cities')
        ? $this->allow()
        : $this->deny('You can not delete this city');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, City $city)
    {
        //
    }
}
