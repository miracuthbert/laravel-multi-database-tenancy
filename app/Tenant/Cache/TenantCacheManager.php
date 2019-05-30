<?php

namespace App\Tenant\Cache;

use App\Tenant\Manager;
use Illuminate\Cache\CacheManager;

class TenantCacheManager extends CacheManager
{
    /**
     * Dynamically call the default driver instance.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if ($method === 'tags') {
            return $this->store()->tags(
                array_merge($this->getTenantCacheTag(), ...$parameters)
            );
        }

        return $this->store()->tags($this->getTenantCacheTag())->$method(...$parameters);
    }

    /**
     * Get tenant's cache tag.
     * 
     * @return array
     */
    protected function getTenantCacheTag()
    {
        return ['tenant_' . $this->app[Manager::class]->getTenant()->uuid];
    }
}