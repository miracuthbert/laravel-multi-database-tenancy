<?php

namespace App\Tenant;

use App\Tenant\Models\Tenant;

class Manager
{
    /**
     * Instance of tenant.
     *
     * @var $tenant
     */
    protected $tenant;

    /**
     * Get tenant.
     *
     * @return mixed
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * Set tenant.
     *
     * @param mixed $tenant
     */
    public function setTenant(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Check if tenant exists in request.
     *
     * @return bool
     */
    public function hasTenant()
    {
        return isset($this->tenant);
    }
}