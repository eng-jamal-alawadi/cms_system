<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends =['status'];

    public function getStatusAttribute(){

        return $this->active ? "Active" : "Disabled";
    }

    // public function roles(){
    //     return $this->belongsToMany(Role::class);
    // }
    public function isSuperAdmin(){
        return $this->hasRole('Super Admin');
    }


}
/**
 * Hirarical Inheritance
 * A{}
 * B{}
 * C{}
 * D{}
 *
 * B extends A{}
 * C extends A{}
 * D extends A{}
 */

 /**
  * Polymorphic Relations
  *     1. One to Many
  *    2. Many to Many
  *   3. One to One
  * 4. Many to One
  *
  */

/**
 *Multi Level Inheritance
    * A{}
    * B{}
    * C{}
    * D{}
    * A extends B{}
    * C extends A{}
    * D extends C{}
    *
 */

 /**
  * Singel Level Inheritance
  * A{}
  * B{}
  * C{}
  * D{}
  * A extends B{}
  * C extends D{}
  *
  */

  /**
   * RelationShip in laravel
   * 1. One to One
   * 2. One to Many
   * 3. Many to Many
   * 4. Many to One
   * hasOne through
   * hasMany through
   * belongsTo
   * belongsToMany
   * hasMany
   * hasOne
   * morphOne
   * morphMany
   * morphTo
   * morphToMany
   *
   */
