<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    // public function before( $admin , $ability){
    //     if($admin->roles->pluck('name')->contains('Super-Admin')){
    //         return true;
    //     }
    // }

    public function viewAny($user)
    {
        // return $user->hasPermissionTo('Read-Role')
        // ? $this->allow()
        // : $this->deny('You can not view any role');


        // if($admin->permissions->pluck('name')->contains('Read-Role')){
        //     return true;
        // }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( $user, Role $role)
    {

            // return $user->hasPermissionTo('Read-Role')
            // ? $this->allow()
            // : $this->deny('You can not view any role');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(  $user)
    {
        // return $user->hasPermissionTo('Create-Role')
        // ? $this->allow()
        // : $this->deny('You can not create a role');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(  $user, Role $role)
    {
        // return $user->hasPermissionTo('Update-Role')
        // ? $this->allow()
        // : $this->deny('You can not update a role');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(  $user, Role $role)
    {
        // return $user->hasPermissionTo('Delete-Role')
        // ? $this->allow()
        // : $this->deny('You can not delete a role');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
