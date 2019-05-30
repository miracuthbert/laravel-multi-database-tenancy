<?php

namespace App\Tenant\Traits;

trait ForTenants
{
    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return 'tenant';
    }
}