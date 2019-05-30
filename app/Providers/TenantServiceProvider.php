<?php

namespace App\Providers;

use App\Console\Commands\Tenant\Migrate;
use App\Console\Commands\Tenant\MigrateRefresh;
use App\Console\Commands\Tenant\MigrateRollback;
use App\Console\Commands\Tenant\Seed;
use App\Tenant\Cache\TenantCacheManager;
use App\Tenant\Database\TenantDatabaseManager;
use App\Tenant\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Manager::class, function () {
            return new Manager();
        });

        Request::macro('tenant', function () {
            return app(Manager::class)->getTenant();
        });

        Blade::if ('tenant', function () {
            return app(Manager::class)->hasTenant();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Migrate::class, function ($app) {
            return new Migrate($app->make('migrator'), $app->make(TenantDatabaseManager::class));
        });

        $this->app->singleton(MigrateRollback::class, function ($app) {
            return new MigrateRollback($app->make('migrator'), $app->make(TenantDatabaseManager::class));
        });

        $this->app->singleton(MigrateRefresh::class, function ($app) {
            return new MigrateRefresh($app->make('migrator'), $app->make(TenantDatabaseManager::class));
        });

        $this->app->singleton(Seed::class, function ($app) {
            return new Seed($app->make('db'), $app->make(TenantDatabaseManager::class));
        });

        $this->app->extend('cache', function () {
            return new TenantCacheManager($this->app);
        });
    }
}
