<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan([
            'basic-user' => 'Basic user',
            'super-admin' => 'Super administrator',
            'system-admin' => 'System administrator',
            'tenant-admin' => 'Tenant administrator',
            'common-admin' => 'Common admin',
            'client-admin' => 'Client admin',
            'outter-client' => 'Client extern',
        ]);

        /*
        Passport::tokensExpireIn(now()->addSeconds(config('api-authentication.tokens_expiring_on_seconds') ));
        Passport::refreshTokensExpireIn(now()->addDays( config('api-authentication.refresh_tokens_expiring_on_days') ));
        Passport::personalAccessTokensExpireIn(now()->addMonths( config('api-authentication.personal_access_tokens_expiring_on_months') ));
        */

    }
}
