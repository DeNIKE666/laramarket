<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('is-admin', function (User $user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::deny();
        });

        Gate::define('is-partner', function (User $user) {
            return $user->isPartner()
                ? Response::allow()
                : Response::deny();
        });

        Gate::define('is-seller', function (User $user) {
            return ($user->isSeller() or $user->isAdmin())
                ? Response::allow()
                : Response::deny();
        });

        Gate::define('is-buyer', function (User $user) {
            return $user->isBuyer()
                ? Response::allow()
                : Response::deny();
        });

        Gate::define('update-post', function ($user, $post) {
            if ($user->role == User::ROLE_ADMIN || $user->id == $post->user_id) {
                return true;
            }
            return false;
        });

        //
    }
}
