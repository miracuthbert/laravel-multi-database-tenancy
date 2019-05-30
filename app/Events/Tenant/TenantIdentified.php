<?php

namespace App\Events\Tenant;

use App\Tenant\Models\Tenant;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TenantIdentified
{
    use Dispatchable, SerializesModels;

    /**
     * Tenant instance.
     *
     * @var Tenant
     */
    public $tenant;

    /**
     * Create a new event instance.
     *
     * @param Tenant $tenant
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }
}
