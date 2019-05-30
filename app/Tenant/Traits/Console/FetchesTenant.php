<?php

namespace App\Tenant\Traits\Console;

use App\Company;

trait FetchesTenant
{
    /**
     * Get tenants within given ids.
     *
     * @param null $ids
     * @return $this|\Illuminate\Database\Eloquent\Builder
     */
    public function tenants($ids = null)
    {
        // fetch tenants
        $tenants = Company::query();

        if ($ids) {
            $tenants = $tenants->whereIn('id', $ids);
        }

        return $tenants;
    }
}