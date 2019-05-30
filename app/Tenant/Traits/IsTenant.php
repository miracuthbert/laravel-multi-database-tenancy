<?php

namespace App\Tenant\Traits;

use App\Tenant\Models\Tenant;
use App\TenantConnection;
use Webpatser\Uuid\Uuid;

trait IsTenant
{
    public static function bootIsTenant()
    {
        static::creating(function ($tenant) {
            $tenant->uuid = Uuid::generate(4);
        });

        static::created(function ($tenant) {
            $tenant->tenantConnection()->save(static::newDatabaseConnection($tenant));
        });
    }

    /**
     * Setup new tenant database connection.
     *
     * @param Tenant $tenant
     * @return TenantConnection
     */
    protected static function newDatabaseConnection(Tenant $tenant)
    {
        return new TenantConnection([
            'database' => config('tenancy.connection.database.prefix') . '_' . $tenant->id,
        ]);
    }

    /**
     * Get company's database connection.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tenantConnection()
    {
        return $this->hasOne(TenantConnection::class, 'company_id', 'id');
    }
}