<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\Tenant\TenantWasCreated' => [
            'App\Listeners\Tenant\CreateTenantDatabase',
        ],
        'App\Events\Tenant\TenantIdentified' => [
            'App\Listeners\Tenant\RegisterTenant',
            'App\Listeners\Tenant\UseTenantFileSystem',
        ],
        'App\Events\Tenant\TenantDatabaseCreated' => [
            'App\Listeners\Tenant\SetUpTenantDatabase',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
