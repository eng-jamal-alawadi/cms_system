<?php

namespace App\Policies;


use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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


    public function viewAny($user)
    {
        return $user->hasPermissionTo('Read-Categories')
        ? $this->allow()
        : $this->deny('You can not view any category');

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-Categories')
        ? $this->allow()
        : $this->deny('You can not create a category');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Category $category)
    {
        return $user->hasPermissionTo('Update-Categories')
        ? $this->allow()
        : $this->deny('You can not update a category');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Category $category)
    {
        // return auth('user')->check() || auth('api')->check() || auth('admin')->check()
        // && $category->user_id == $user->id
        // && $user->hasPermissionTo('Delete-Categories')
        // ? $this->allow()
        // : $this->deny('You can not delete a category');

        return $user->hasPermissionTo('Delete-Categories')
        ? $this->allow()
        : $this->deny('You can not delete a category');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( $user, Category $category)
    {

        return $user->hasAnyPermissionTo('Create-Categories','Edit-Categories')
        ? $this->allow()
        : $this->deny('You can not Create a category');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
