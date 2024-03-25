<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('admin', function(User $user) {
            if ($user->admin == true) {
                return $user->admin;
            }
        });
        
        // Gate::define('nivel-1', function(User $user) {
        //     return $user->email == 'admin@ascom.br';
        // });

        // Gate::define('nivel-2', function(User $user) {
        //     return $user->email == 'admin@dds.br';
        // });

        // Gate::define('nivel-3', function(User $user) {
        //     return $user->email == 'admin@infra.br';
        // });

        // Gate::define('nivel-4', function(User $user) {
        //     return $user->email == 'admin@suporte.br';
        // });

    }
}
