<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Switch user to specific tenant.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function switch(Company $company)
    {
        session()->put('tenant', $company->uuid);

        return redirect('/home');
    }
}
