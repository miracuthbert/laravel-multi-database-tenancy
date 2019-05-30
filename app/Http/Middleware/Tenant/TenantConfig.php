<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class TenantConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tenant = $request->tenant();

        // switch app's configurations with tenant's
        if ($tenant) {
            config()->set('app.name', $tenant->name);
        }

        return $next($request);
    }
}
