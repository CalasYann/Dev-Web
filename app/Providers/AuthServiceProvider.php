<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot()
    {
        $this->registerPolicies();

        // Exemple de Gate basé sur un rôle
        Gate::define('admin-access', function ($user) {
            return $user->hasRole('administrateur'); // Vérifie si l'utilisateur a le rôle "administrateur"
        });
    }
}
