<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('role-user', function (User $user) {
            return $user->role == User::ROLE_USER ? true : false;
        });

        Gate::define('role-shop', function (User $user) {
            return $user->role == User::ROLE_SHOP ? true : false;
        });

        Gate::define('role-admin', function (User $user) {
            return $user->role == User::ROLE_ADMIN ? true : false;
        });

        Gate::define('is-partner', function (User $user) {
            return $user->is_partner == 1 ? true : false;
        });

        Gate::define('update-post', function($user, $post){
            if($user->role == User::ROLE_ADMIN || $user->id == $post->user_id){
                return true;
            }
            return false;
        });

        //
    }
}
