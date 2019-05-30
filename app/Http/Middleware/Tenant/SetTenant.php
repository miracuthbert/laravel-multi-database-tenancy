<?php

namespace App\Http\Middleware\Tenant;

use App\Company;
use App\Events\Tenant\TenantIdentified;
use Closure;

class SetTenant
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
        $tenant = $this->resolveTenant(session('tenant', $request->company));

        if (!$tenant) {
            return redirect('/companies');
        }

        if (!auth()->user()->companies->contains('id', $tenant->id)) {
            return redirect('/home');
        }

        event(new TenantIdentified($tenant));

        return $next($request);
    }

    /**
     * Resolve the tenant.
     *
     * @param $uuid
     * @return mixed
     */
    protected function resolveTenant($uuid)
    {
        return Company::where('uuid', $uuid)->first();
    }
}
