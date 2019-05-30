<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class NavigationViewComposer
{
    private $companies;

    /**
     * Share data with navigation view (partial).
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        if (!$this->companies) {
            $this->companies = auth()->check() ? auth()->user()->companies : collect([]);
        }

        $view->with('user_companies', $this->companies);
    }
}