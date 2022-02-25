<?php

namespace App\Providers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();



        Gate::before(function (  $admin){
            if($admin->roles->pluck('name')->contains('Super-Admin')){
                return true;
            }
        });

        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonth());
        Passport::routes();


    }
}
