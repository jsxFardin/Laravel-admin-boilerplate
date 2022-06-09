<?php

namespace App\Providers;

use App\Models\Permission;
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
    public function boot(User $user)
    {
        $this->registerPolicies();

        try {
            $permissions = Permission::with('roles')->get();
        } catch (\Exception $e) {
            return [];
        }

        foreach ($permissions as $permission) {
            Gate::define($permission->name, function(User $user) use ($permission) { 
                if ($user->isAdmin()) { //ADMIN PERMISSIONS
                    return true;
                }
                return $user->hasPermission($permission);
            });
        }
    }
}
