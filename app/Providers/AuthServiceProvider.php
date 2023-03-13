<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('dev', function (User $user) {
            return $user->role_id == '1';
        });

        Gate::define('super-admin', function (User $user) {
            // return $user->role_id < '3';
            $logika = ($user->role_id == 1 || $user->role->id == 2);
            return $logika;
        });

        Gate::define('admin', function (User $user) {
            return $user->role_id == '3';
        });

        Gate::define('onlyAdmin', function (User $user) {
            // return $user->role_id == '3';
            return in_array($user->role_id, [1, 2, 3]);
        });

        Gate::define('inspektur', function (User $user) {
            return $user->role_id == '4';
        });

        Gate::define('irban', function (User $user) {
            return $user->role_id == '5';
        });
    }
}
