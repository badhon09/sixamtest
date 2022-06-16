<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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

        Gate::define('product_add', function ($user) {
            $permissions = \App\Models\User::with('permission')->find(Auth::user()->user_id)->permission->pluck('permissionHeader.header_name')->toArray();

            if (in_array('product_add', $permissions)) {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('product_edit', function ($user) {
            $permissions = \App\Models\User::with('permission')->find(Auth::user()->user_id)->permission->pluck('permissionHeader.header_name')->toArray();

            if (in_array('product_edit', $permissions)) {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('product_delete', function ($user) {
            $permissions = \App\Models\User::with('permission')->find(Auth::user()->user_id)->permission->pluck('permissionHeader.header_name')->toArray();

            if (in_array('product_delete', $permissions)) {
                return true;
            } else {
                return false;
            }
        });
    }
}
