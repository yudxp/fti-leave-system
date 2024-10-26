<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
// use App\Policies\RolePolicy;
// use App\Policies\PermissionPolicy;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user, string $ability) {
            return $user->isSuperAdmin() ? true: null;
        });
        // Gate::policy(Role::class, RolePolicy::class);
        // Gate::policy(Permission::class, PermissionPolicy::class);
    }
}
