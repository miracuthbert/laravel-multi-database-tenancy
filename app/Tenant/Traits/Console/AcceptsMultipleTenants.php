<?php

namespace App\Tenant\Traits\Console;

use Symfony\Component\Console\Input\InputOption;

trait AcceptsMultipleTenants
{
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(
            parent::getOptions(), [
                ['tenants', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, '', null]
            ]
        );
    }
}