<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantIdentified;
use App\Tenant\Models\Tenant;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UseTenantFileSystem
{
    /**
     * Filesystem instance.
     *
     * @var Factory
     */
    public $filesystem;

    /**
     * Create the event listener.
     *
     * @param Factory $filesystem
     */
    public function __construct(Factory $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Handle the event.
     *
     * @param  TenantIdentified  $event
     * @return void
     */
    public function handle(TenantIdentified $event)
    {
        $this->filesystem->set(
            'tenant',
            $this->createDriver($this->getFilesystemConfig($event->tenant))
        );
    }

    /**
     * Create tenant's driver.
     *
     * @param $config
     * @return mixed
     */
    protected function createDriver($config)
    {
        $method = $this->getCreationMethod();

        return $this->filesystem->{$method}($config);
    }

    /**
     * Get and set tenant specific filesystem config.
     *
     * @param Tenant $tenant
     * @return string
     */
    protected function getFilesystemConfig(Tenant $tenant)
    {
        $config = config('filesystems.disks.' . config('filesystems.default'));

        $config['root'] = storage_path('app/tenant/') . $tenant->uuid;

        return $config;
    }

    /**
     * Get the driver to be created based on default filesystems driver.
     *
     * @return string
     */
    protected function getCreationMethod()
    {
        return "create" . ucfirst(config('filesystems.default')) . "Driver";
    }
}
